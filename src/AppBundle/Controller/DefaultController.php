<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/login.html.twig');
    }

    public function loginAction()
    {

         //Llamamos al servicio de autenticacion
        $authenticationUtils = $this->get('security.authentication_utils');

        // conseguir el error del login si falla
        $error = $authenticationUtils->getLastAuthenticationError();

        // ultimo nombre de usuario que se ha intentado identificar
        $lastUsername = $authenticationUtils->getLastUsername();

        $u=$this->getUser();

        if($u!=null){

            $role=$u->getRol();
            
                if($role=="Administrador"){
                    return $this->redirectToRoute('administradorPage');
                }else if($role=="Tesorero"){
                    return $this->redirectToRoute('tesoreroPage');
                }else if($role=="obrero"){
                    return $this->redirectToRoute('obreroPage');
                }
            
            

        }else{
            //$this->notificacion("error","no hay usuario");
            return $this->render('default/login.html.twig');
        }
        // replace this example code with whatever you need
        return $this->render('default/login.html.twig');
    }

}
