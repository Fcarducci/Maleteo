<?php

namespace App\Form;

use App\Entity\Opiniones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpinionFormulario extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    
   $builder->add('autor',TextType::class, array('attr' => array('placeholder' => 'Francesco Carducci', 'label'=>'Nombre')));
   $builder->add('ciudad', ChoiceType::class, ['choices' => ['Madrid' => 'Madrid','Sevilla' => 'Sevilla','Barcelona' => 'Barcelona'],'placeholder' => 'Elige la ciudad', 'label'=>'Ciudad']);
   $builder->add('comentario', TextareaType::class, array('attr' => array('placeholder' => 'Escribe un coementario', 'label'=>'Comentario')));

  }

  public function configureOptions(OptionsResolver $resolver)
  {

   $resolver->setDefaults(['data_class' => Opiniones::class]);

  }

}