<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Symfony\Component\Form\Extension\Core\Type\date('d/m/y');

class MiembroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('apellidos', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('estadoCivil', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('fechaNac')
            ->add('genero', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('email', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('direccion', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('telefonoFijo', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('telefonoMovil', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('nacionalidad', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('profesion', TextType::class ,array('attr' => array('class' => 'form-control')))
            ->add('fechaAceptacion');
            
            //->add('profesion')
            //->add('fechaAceptacion');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Miembro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_miembro';
    }


}
