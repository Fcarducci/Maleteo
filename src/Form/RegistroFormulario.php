<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UsuariosRegistrados;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroFormulario extends AbstractType
{

 public function buildForm(FormBuilderInterface $builder, array $options)
 {

  $builder->add('nombre',TextType::class, array('attr' => array('placeholder' => 'Nombre', 'required' => true)));
  $builder->add('apellido',TextType::class, array('attr' => array('placeholder' => 'Apellido', 'required' => true)));
  $builder->add('email',EmailType::class, array('attr' => array('placeholder' => 'Email', 'required' => true)));
  $builder->add('ciudad', ChoiceType::class, ['choices' => ['Madrid' => 'Madrid','Sevilla' => 'Sevilla','Barcelona' => 'Barcelona'],'placeholder' => 'Elige la ciudad', 'label'=>'Ciudad']);
  $builder->add('password',PasswordType::class, array('attr' => array('placeholder' => 'Contraseña', 'required' => true)));
  $builder->add('politica', CheckboxType::class, ['label' => 'Acepto la    ','required' => true]);


 }

 public function configureOptions(OptionsResolver $resolver)
 {

  $resolver->setDefaults(['data_class' => User::class]);

 }

}

