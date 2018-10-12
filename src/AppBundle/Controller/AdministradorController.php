<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Miembro;
use AppBundle\Form\MiembroType;
use AppBundle\Form\UsuarioType;

class AdministradorController extends Controller
{

    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('administrador/index.html.twig');
    }

    public function usuariosAction(){
      $repository = $this->getDoctrine()->getRepository(Usuario::class);
      $usuarios = $repository->findAll();
    	return $this->render('administrador/usuarios.html.twig',array(
        'usuarios'=>$usuarios
      ));
    }

    public function nuevoUsuarioAction(Request $request){
      $usuario = new Usuario();

      $form=$this->createForm(UsuarioType::class, $usuario);


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $em = $this->getDoctrine()->getManager();

        $opciones = ['cost' => 4,];
        $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_BCRYPT, $opciones));
        $em->persist($usuario);
        $em->flush();
        return $this->redirectToRoute('usuarios');
      }

       return $this->render('administrador/nuevoUsuario.html.twig',array("form"=>$form->createView() ));

    }

    public function miembrosAction(){
      $repository = $this->getDoctrine()->getRepository(Miembro::class);
      $miembros = $repository->findAll();

      return $this->render('administrador/miembros.html.twig',array(
        'miembros'=>$miembros
      ));
    }

    public function nuevoMiembroAction(Request $request){
      $miembro = new Miembro();

      $form=$this->createForm(MiembroType::class, $miembro);
      $user = $this->get('security.token_storage')->getToken()->getUser();


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $em = $this->getDoctrine()->getManager();
        $miembro->setUsuariousuario($user);

        
        $em->persist($miembro);
        $em->flush();
        return $this->redirectToRoute('miembros');
      }

       return $this->render('administrador/nuevoMiembro.html.twig',array("form"=>$form->createView() ));

    }

    

}
