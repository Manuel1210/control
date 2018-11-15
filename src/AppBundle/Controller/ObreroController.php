<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Ministerio;
use AppBundle\Entity\Liderministerio;
use AppBundle\Entity\Miembro;

class ObreroController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()-> getRepository(Ministerio::class);
        $ministerios= $repository->findAll();

        return $this->render('obrero/index.html.twig',array(
            'ministerios'=> $ministerios
        ));
    }

    public function reportesObreroAction(){

        return $this->render('obrero/reportesObrero.html.twig');
    }

    public function detalleObreroministerioAction($id){
        $ministerio = $this->getDoctrine()-> getRepository(Ministerio::class)->findOneByIdministerio($id);

  $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
  $query = $repositorylider->createQueryBuilder('l')
      ->where('l.ministerioministerio = :ministerio')
      ->andWhere('l.estado = 1')
      ->setParameter('ministerio', $ministerio)
      ->getQuery();

        $lider = $query->getResult();


        $miembros = $this->getDoctrine()-> getRepository(Miembro::class)->findByMinisterioministerio($ministerio);

        return $this->render('obrero/detalleObreroministerio.html.twig',array(
            'ministerio'=>$ministerio,
            'lider' => $lider,
            'miembros' => $miembros
        ));
    }

    public function reporteObreroministerioAction(){
        $repository = $this->getDoctrine()-> getRepository(Ministerio::class);
        $ministerios= $repository->findAll();

        return $this->render('obrero/reporteObreroministerio.html.twig',array(
            'ministerios' => $ministerios
        ));
    }

    public function reporteObreroliderministerioAction(){
        return $this->render('obrero/reporteObreroliderministerio.html.twig');
    }



    

}
