<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Miembro;
use AppBundle\Form\MiembroType;
use AppBundle\Form\UsuarioType;
use AppBundle\Entity\Presentacion;
use AppBundle\Form\PresentacionType;
use AppBundle\Entity\Bautizo;
use AppBundle\Form\BautizoType;
use AppBundle\Entity\Ministerio;
use AppBundle\Entity\Liderministerio;

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

    public function presentacionAction(){
      $repository = $this->getDoctrine()->getRepository(Presentacion::class);
      $presentacion=$repository->findAll();

      return $this->render('administrador/presentacion.html.twig', array('Presentacion' => $presentacion
       ));
    }

    public function nuevaPresentacionAction(Request $request){
      $presentacion = new Presentacion();

      $form=$this->createForm(PresentacionType::class,$presentacion);
      $user= $this->get('security.token_storage')->getToken()->getUser();

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $presentacion->setUsuariousuario($user);

        $em->persist($presentacion);
        $em->flush();
        return $this->redirectToRoute('presentacion');
      }
      return $this->render('administrador/nuevaPresentacion.html.twig', array("form"=>$form->createView() ));
    }


public function bautizadosAction(){
      $repository = $this->getDoctrine()->getRepository(Bautizo::class);
      $bautizos=$repository->findAll();

      return $this->render('administrador/bautizados.html.twig', array('bautizos' => $bautizos
       ));
    }
 

public function seleccionarMiembroAction(){
      $repository = $this->getDoctrine()->getRepository(Miembro::class);
      $miembros = $repository->findAll();
      //$miembros = $repository->findOneByIdmiembro($id);
      return $this->render('administrador/seleccionarMiembro.html.twig',array(
      'miembros'=>$miembros
    ));
    }

public function nuevoBautizoAction(Request $request){
  $bautizo = new Bautizo();
  $em=$this->getDoctrine()->getManager();
  $form=$this->createForm(BautizoType::class, $bautizo);

  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
      

      $em->persist($bautizo);
      $em->flush();
      return $this->redirectToRoute('bautizados');
    }  
  return $this->render('administrador/nuevoBautizo.html.twig', array("form"=>$form->createView() ));
}


public function ministerioAction(){
  $repository = $this->getDoctrine()-> getRepository(Ministerio::class);
  $ministerio= $repository->findAll();

  return $this->render('administrador/ministerio.html.twig', array('ministerios'=>$ministerio));
}

public function asignarMiembroAction($id){
      $repository = $this->getDoctrine()->getRepository(Miembro::class);
      $miembros = $repository->findAll();

      return $this->render('administrador/asignarMiembro.html.twig', array('miembros'=>$miembros
      ));
    }

public function asignarLiderAction($id){
      $repository = $this->getDoctrine()->getRepository(Miembro::class);
      $miembros = $repository->findAll();

      return $this->render('administrador/asignarLider.html.twig', array('miembros'=>$miembros
      ));
    }


  public function asignacionLiderMinisterioAction($id){
    $liderministerio = new Liderministerio();
  $form=$this->createForm(LiderministerioType::class, $liderministerio);

  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
      $em=$this->getDoctrine()->getManager();
      $em->persist($liderministerio);

      $em->flush();
      return $this->redirectToRoute('asignacionMiembroLider');
    }  
  return $this->render('administrador/asignacionMiembroLider.html.twig', array("form"=>$form->createView() ));
  }


  public function asignarMiembroMinisterio($id){

  }
}
