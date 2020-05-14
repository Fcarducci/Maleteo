<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Formulario extends AbstractType{




 public function buildForm(FormBuilderInterface $builder, array $options)
 {
   
  $builder->add('nombre',TextType::class, array('attr' => array('placeholder' => 'Francesco Carducci', 'label'=>'Nombre', 'required' => true)));
  $builder->add('email', EmailType::class, array('attr' => array('placeholder' => 'Francesco@upgrade.com', 'label'=>'Email', 'required' => true)));
  $builder->add('ciudad', ChoiceType::class, ['choices' => ['Madrid' => 'Madrid','Sevilla' => 'Sevilla','Barcelona' => 'Barcelona'],'placeholder' => 'Elige la ciudad', 'label'=>'Ciudad', 'required' => true]);

  $builder->add('politica', CheckboxType::class, ['label' => 'Acepto la','required' => true,]);

 }

//  public function configureOptions(OptionsResolver $resolver)
//  {
//  $resolver->setDefaults(['data_class' => Usuario::class]);
//  }

 
}