<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Caja;
use AppBundle\Entity\TIpotransaccion;
use AppBundle\Entity\Inoutcaja;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class TesoreroController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $caja = $this->getDoctrine()->getRepository(Caja::class)->findOneByIdcaja(1);
        $transacciones = $this->getDoctrine()->getRepository(Inoutcaja::class)->findByCajacaja($caja);
        $tipotransaccion=$this->getDoctrine()->getRepository(Tipotransaccion::class)->findAll();

        $validar=count($tipotransaccion);
        // replace this example code with whatever you need
        return $this->render('tesorero/index.html.twig',array(
            'transacciones' => $transacciones,
            'caja' => $caja,
            'validar' => $validar
        ));
    }

    public function fechaBusquedatesoreriaAction(Request $request){
        $form=$this->createFormBuilder()
            ->add('fechainicial',DateType::class, array(
                // render as a single text box
                'widget' => 'single_text','label'=>'Fecha Inicio','attr'=>array('class'=>'form-control'),
                ))
            ->add('fechafinal',DateType::class, array(
                // render as a single text box
                'widget' => 'single_text','label'=>'Fecha Final','attr'=>array('class'=>'form-control'),
                ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fecha1=$form->get('fechainicial')->getData();
            $fecha2=$form->get('fechafinal')->getData();
            


            if($fecha1<$fecha2){
                $caja = $this->getDoctrine()->getRepository(Caja::class)->findOneByIdcaja(1);
                $repository=$this->getDoctrine()->getRepository(Inoutcaja::class);
                $query = $repository->createQueryBuilder('f')
                    ->where('f.fecha >= :fechainicio')
                    ->andWhere('f.fecha <= :fechafinal')
                    ->setParameter('fechainicio', $fecha1)
                    ->setParameter('fechafinal', $fecha2)
                    ->orderBy('f.fecha', 'ASC')
                    ->getQuery();

                $transacciones = $query->getResult();
            }

            return $this->render('tesorero/resultadoBusquedatesoreria.html.twig',array(
                'fecha1'=>$fecha1,
                'fecha2'=>$fecha2,
                'transacciones'=>$transacciones,
                'caja'=>$caja
            ));
        }

      return $this->render('tesorero/fechaBusquedatesoreria.html.twig',
      array('form'=>$form->createView()));
    }

    

}
