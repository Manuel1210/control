<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MiembroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apellidos')
            ->add('estadoCivil')
            ->add('fechaNac')
            ->add('genero')
            ->add('email')
            ->add('direccion')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('nacionalidad')
            ->add('profesion')
            ->add('fechaAceptacion');
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
