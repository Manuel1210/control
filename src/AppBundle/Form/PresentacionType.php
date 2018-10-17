<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class PresentacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombres', textType::class, array('attr'=>array('class'=>'form-control'))) 
        ->add('apellidos', textType::class, array('attr'=>array('class'=>'form-control')))
        ->add('fechaNac')
        ->add('nombresPapa', textType::class, array('attr'=>array('class'=>'form-control')))
        ->add('nombresMama', textType::class, array('attr'=>array('class'=>'form-control')))
        ->add('fechaPresentacion');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Presentacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_presentacion';
    }


}
