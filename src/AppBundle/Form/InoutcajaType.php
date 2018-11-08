<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Tipotransaccion;


class InoutcajaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('descripcion', TextType::class, array('attr'=>array('class'=>'form-control')))
        ->add('cantidad', TextType::class, array('attr'=>array('class'=>'form-control')))
        ->add('fecha', DateType::class, array('attr'=>array('class'=>'form-control'),'widget' => 'single_text', 'html5'=>'true'))
        ->add('tipotransacciontipotransaccion', EntityType::class, array(
            // looks for choices from this entity
            'class' => 'AppBundle:Tipotransaccion',
            // uses the User.username property as the visible option string
            'choice_label' => 'nombre',
            'label'=> 'Tipo Transaccion',
            'attr'=>array('class'=>'form-control')  
         ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Inoutcaja'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_inoutcaja';
    }


}
