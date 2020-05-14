<?php

namespace App\Controller\Maleteo;


use App\Entity\Opiniones;
use App\Entity\Usuario;
use App\Entity\UsuariosRegistrados;
use App\Form\Formulario;
use App\Form\LoginForm;
use App\Form\OpinionFormulario;
use App\Form\RegistroFormulario;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Math;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class MaleteoController extends AbstractController
{
/**
 * @Route("/", name="home")
 */

  public function index(EntityManagerInterface $em ,Request $request)
  {
    $form=$this->createForm(Formulario::class);
  
    //* Mostrar Opiniones Aleatorias;
    $repo=$em->getRepository(Opiniones::class);
    $opiniones=$repo->findAll();
    $opinionesRandom=array_rand($opiniones, 3);
    
    for($i=0; $i<3; $i++ ) {
      $opinionesPublicacion[]=$opiniones[$opinionesRandom[$i]];
    }

    return $this->render("maleteo/maleteo.html.twig", ["demoForm"=>$form->createView(), "opiniones"=>$opinionesPublicacion]);
    
  } 

  /**
 * @Route("/demo/submit", methods={"POST"}, name="demo_new")
 */

public function demo(EntityManagerInterface $em, Request $request)
{
  $form=$this->createForm(Formulario::class);
  $form->handleRequest($request);
  $datos=json_decode($request->getContent(), true);
  // dd($datos);
  
  // if($form->isSubmitted() && $form->isValid()){

    
    $usuario=new Usuario();
    $usuario->setNombre($datos['nombre']);
    $usuario->setEmail($datos['email']);
    $usuario->setCiudad($datos['ciudad']);
    $em->persist($usuario);
    $em->flush();
    // $em->persist($usuario);
    // $em->flush();

    return new JsonResponse(["msg"=>"Solicitud enviada correctamente!"]);
  // };

  
} 

  /**
   * @Route("/solicitudes", name="usuarios")
   * @IsGranted("ROLE_ADMIN")
   */

  public function getDemos(EntityManagerInterface $em)
  {

    $repo=$em->getRepository(Usuario::class);
    $user=$repo->findAll();
    return $this->render("maleteo/listaDemos.html.twig", ["usuarios"=>$user]);

  } 

  /**
 * @Route("/solicitudes/{id}/borrar", name="delete")
 */
 public function borrarSolicitud(Usuario $solicitud, EntityManagerInterface $em)
 {
 $em->remove($solicitud);
 $em->flush();
 return new RedirectResponse('/solicitudes');
 }

    /**
   * @Route("/opiniones", name="opinar")
   */

  public function opinionesForm(EntityManagerInterface $em, Request $request)
  {

    $form=$this->createForm(OpinionFormulario::class);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      // $email = $request->request->get('email');
      // $findUser=$repositorio->findOneBy(['email'=>$email]);
      $usuarioOpinion=$form->getData();
      $em->persist($usuarioOpinion);
      $em->flush();
      return $this->redirectToRoute("home");
    }
    return $this->render("maleteo/opinionesForm.html.twig", ["demoFormOp"=>$form->createView()]);

  } 

  /**
   * @Route("/opiniones/lista", name="lista de opiniones")
   * @IsGranted("ROLE_ADMIN")
   */

   public function listaOpiniones(EntityManagerInterface $em)
   {
    $repo=$em->getRepository(Opiniones::class);
    $opiniones=$repo->findAll();
    return $this->render("maleteo/listaOp.html.twig", ["opiniones"=>$opiniones]);
   }

  /**
 * @Route("/opiniones/lista/{id}/borrar", name="deleteOp")
 */
 public function borrarOpiniones(Opiniones $solicitud, EntityManagerInterface $em)
 {
 $em->remove($solicitud);
 $em->flush();
 return new RedirectResponse('/opiniones/lista');
 }

  // /**
  //  * @Route("/maleteo/login")
  //  */

  // public function signin(EntityManagerInterface $em, Request $request)
  // {
  //   $form=$this->createForm(LoginForm::class);
  //   $form->handleRequest($request);

  //   $repo=$em->getRepository(UsuariosRegistrados::class);
    
    
  //   if($form->isSubmitted() && $form->isValid()){
  //     $usuarioLogin=$form->getData();
      
  //     $userRegister=$repo->findOneBy(['email'=>$usuarioLogin['email'], 'password'=>$usuarioLogin['password']]);
  //     if($userRegister!=null){
  //       return $this->redirectToRoute("home");
  //     }else{
  //       return $this->redirectToRoute("registro");
  //     }


  //   }



 
    
  //   // if($userRegister==null){
  //   //   return $this->redirectToRoute("registro");
  //   // }
      
  //     return $this->render("maleteo/signin.html.twig", ["loginForm"=>$form->createView()]);
   
  

  // } 

  /**
   * @Route("registro/error", name="error")
   */

   public function errorRegistro()
   {
    return $this->render("maleteo/maleteoError.html.twig");
   }

    /**
   * @Route("/registro", name="registro")
   */

  public function registro(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncode)
  {
    $form=$this->createForm(RegistroFormulario::class);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){ 
      try{

        $user=$form->getData();
        $passwordCifrada=$passwordEncode->encodePassword($user, $user->getPassword());
        $user->setPassword($passwordCifrada);
        $usuarioRegistrado=$user;
        $em->persist($usuarioRegistrado);
        $em->flush();
        return $this->redirectToRoute("home");
      }catch(\Throwable $th){

        return $this->redirectToRoute("error");

      }

    }


    return $this->render("maleteo/registro.html.twig", ["formRegistro"=>$form->createView()]);

  } 


   


} 