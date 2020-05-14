<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
 

   $builder->add('email',EmailType::class, array('attr' => array('placeholder' => 'Email', 'required' => true)));
   $builder->add('password',PasswordType::class, array('attr' => array('placeholder' => 'Contraseña', 'required' => true)));
   
  }
 


}