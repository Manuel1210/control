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
use AppBundle\Form\MinisterioType;
use AppBundle\Entity\Liderministerio;
use AppBundle\Entity\Caja;
use AppBundle\Entity\Inoutcaja;
use AppBundle\Entity\Tipotransaccion;
use AppBundle\Form\TipotransaccionType;
use AppBundle\Form\InoutcajaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class AdministradorController extends Controller
{

    /**
     * Adds a flash message to the current session for type.
     *
     * @param string $type    The type
     * @param string $message The message
     *
     * @throws \LogicException
     */
    protected function addFlash($type, $message){
    // Retrieve flashbag from the controller
    $flashbag = $this->get('session')->getFlashBag();

    // Add flash message
    $flashbag->add($type, $message);

    }

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

    public function editarUsuarioAction(Request $request,$id){
      $em = $this->getDoctrine()->getManager();

      $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneByIdusuario($id);

      $form = $this->createForm(UsuarioType::class,$usuario,array('action'=>$this->generateUrl('editarUsuario',array('id'=>$usuario->getIdusuario())),
        'method'=>'PUT'));

      $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

          $password=$form->get('password')->getData();
          if(!empty($password)){
            $opciones = ['cost' => 4,];
            $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT, $opciones));
          }else{
            $recoverPass=$this->recoverPass($id);
            $usuario->setPassword($recoverPass[0]['password']);
          }

          $em->flush();

          return $this->redirectToRoute('usuarios');
        }

      return $this->render('administrador/editarUsuario.html.twig',
      array('usuario'=>$usuario, 'form'=>$form->createView()));
    }


    public function miembrosAction(){
      $repository = $this->getDoctrine()->getRepository(Miembro::class);
      $miembros = $repository->findAll();

      return $this->render('administrador/miembros.html.twig',array(
        'miembros'=>$miembros
      ));
    }

    public function detalleMiembroAction($id){
      $miembro = $this->getDoctrine()->getRepository(Miembro::class)->findOneByIdmiembro($id);

      return $this->render('administrador/detalleMiembro.html.twig',array('miembro'=>$miembro));

    }

    public function nuevoMiembroAction(Request $request){
      $miembro = new Miembro();

      $miembro->setfechaNac(new \DateTime("now"));
      $miembro->setFechaaceptacion(new \DateTime("now"));

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

    public function editarMiembroAction(Request $request,$id){
      $em = $this->getDoctrine()->getManager();

      $miembro = $this->getDoctrine()->getRepository(Miembro::class)->findOneByIdmiembro($id);

      $form = $this->createForm(MiembroType::class,$miembro,array('action'=>$this->generateUrl('editarMiembro',array('id'=>$miembro->getIdmiembro())),
        'method'=>'PUT'));

      $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
          $miembro=$form->getData();
          
          if($miembro->getEstado() == 0){
            $ministerio=$miembro->getMinisterioMinisterio();
            if($ministerio!=null){
              $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
              $query = $repositorylider->createQueryBuilder('l')
                  ->where('l.ministerioministerio = :ministerio')
                  ->andWhere('l.estado = 1')
                  ->setParameter('ministerio', $ministerio)
                  ->getQuery();

              $lider = $query->getResult();

              if($lider[0]->getMiembromiembro()==$miembro){
                $this->addFlash("error","Cambie de lider");
              }else{
                $miembro->setMinisterioministerio(null);
                $em->flush();

                $this->addFlash("done","Usuario desabilitado");  
              }
            }
            
          }else{
            $em->flush();
          }
          return $this->redirectToRoute('miembros');
        }

      return $this->render('administrador/editarMiembro.html.twig',
      array('miembro'=>$miembro, 'form'=>$form->createView()));
    }

    public function presentacionAction(){
      $repository = $this->getDoctrine()->getRepository(Presentacion::class);
      $presentacion=$repository->findAll();

      return $this->render('administrador/presentacion.html.twig', array('Presentacion' => $presentacion
       ));
    }

    public function nuevaPresentacionAction(Request $request){
      $presentacion = new Presentacion();
      $presentacion->setfechaNac(new \DateTime("now"));
      $presentacion->setfechaPresentacion(new \DateTime("now"));

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
  $bautizo->setFecha(new \DateTime());
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

public function nuevoMinisterioAction(Request $request){
  $ministerio = new ministerio();
  $ministerio->setfecha(new \DateTime("now"));

  $em = $this->getDoctrine()->getManager();
  $form = $this ->createForm(MinisterioType::class, $ministerio);

  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $em->persist($ministerio);
    $em->flush();
    return $this->redirectToRoute('ministerio');
  }
  return $this->render('administrador/nuevoMinisterio.html.twig', array("form"=>$form->createView() ));
}


public function detallesMinisterioAction($id){
  $ministerio = $this->getDoctrine()-> getRepository(Ministerio::class)->findOneByIdministerio($id);

  $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
  $query = $repositorylider->createQueryBuilder('l')
      ->where('l.ministerioministerio = :ministerio')
      ->andWhere('l.estado = 1')
      ->setParameter('ministerio', $ministerio)
      ->getQuery();

  $lider = $query->getResult();


  $miembros = $this->getDoctrine()-> getRepository(Miembro::class)->findByMinisterioministerio($ministerio);

  return $this->render('administrador/detallesMinisterio.html.twig',array(
    'ministerio'=>$ministerio,
    'lider' => $lider,
    'miembros' => $miembros
  ));  

}

public function asignarLiderAction($id){
      $ministerio = $this->getDoctrine()->getRepository(Ministerio::class)->findOneByIdministerio($id);

      $miembros = $this->getDoctrine()->getRepository(Miembro::class)->findByMinisterioministerio($ministerio);


      return $this->render('administrador/asignarLider.html.twig', array(
        'miembros'=>$miembros,
        'ministerio' =>$ministerio
      ));
    }


  public function asignacionLiderMinisterioAction($id,$idm){
    $ministerio = $this->getDoctrine()->getRepository(Ministerio::class)->findOneByIdministerio($id);
    $miembro = $this->getDoctrine()->getRepository(Miembro::class)->findOneByIdmiembro($idm);
      $em = $this->getDoctrine()->getManager();

        $lideresministerio = $this->getDoctrine()->getRepository(Liderministerio::class)->findByMinisterioministerio($ministerio);

        foreach ($lideresministerio as $lideres) {
          $lideres->setEstado(0);
          $em->flush();

        }

        $lidernuevo=new Liderministerio();
        $lidernuevo->setEstado(1);
        $lidernuevo->setMinisterioministerio($ministerio);
        $lidernuevo->setMiembromiembro($miembro);
        $em->persist($lidernuevo);
        $em->flush();


        $this->addFlash("done","Lider Asignado");

        $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
    $query = $repositorylider->createQueryBuilder('l')
        ->where('l.ministerioministerio = :ministerio')
        ->andWhere('l.estado = 1')
        ->setParameter('ministerio', $ministerio)
        ->getQuery();

    $lider = $query->getResult();


    $miembros = $this->getDoctrine()-> getRepository(Miembro::class)->findByMinisterioministerio($ministerio);

    return $this->render('administrador/detallesMinisterio.html.twig',array(
      'ministerio'=>$ministerio,
      'lider' => $lider,
      'miembros' => $miembros
    ));
  
  }

  public function asignarMiembroMinisterioAction($idm){
    $ministerio = $this->getDoctrine()->getRepository(Ministerio::class)->findOneByIdministerio($idm);
    $miembros = $this->getDoctrine()->getRepository(Miembro::class)->findBy(array('ministerioministerio'=>null,'estado'=>'1'));
    


    return $this->render('administrador/asignarMiembro.html.twig',array(
      'miembros' => $miembros,
      'ministerio' => $ministerio
    ));

  }

  public function asignacionMiembroMinisterioAction($id,$idm){
    $ministerio = $this->getDoctrine()->getRepository(Ministerio::class)->findOneByIdministerio($idm);
    $miembro = $this->getDoctrine()->getRepository(Miembro::class)->findOneByIdmiembro($id);
    $em = $this->getDoctrine()->getManager();


    $miembro->setMinisterioministerio($ministerio);
    $em->flush();

    $this->addFlash("done","Miembro asignado");


    $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
    $query = $repositorylider->createQueryBuilder('l')
        ->where('l.ministerioministerio = :ministerio')
        ->andWhere('l.estado = 1')
        ->setParameter('ministerio', $ministerio)
        ->getQuery();

    $lider = $query->getResult();


    $miembros = $this->getDoctrine()-> getRepository(Miembro::class)->findByMinisterioministerio($ministerio);

    return $this->render('administrador/detallesMinisterio.html.twig',array(
      'ministerio'=>$ministerio,
      'lider' => $lider,
      'miembros' => $miembros
    ));


  }

  public function borrarMiembroMinisterioAction($id){
    $miembro = $this->getDoctrine()->getRepository(Miembro::class)->findOneByIdmiembro($id);
    $idm = $miembro->getMinisterioMinisterio()->getIdministerio();
    $ministerio = $this->getDoctrine()->getRepository(Ministerio::class)->findOneByIdministerio($idm);
    $em = $this->getDoctrine()->getManager();

    $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
    $query = $repositorylider->createQueryBuilder('l')
        ->where('l.ministerioministerio = :ministerio')
        ->andWhere('l.estado = 1')
        ->setParameter('ministerio', $ministerio)
        ->getQuery();

    $lider = $query->getResult();

    if($lider[0]->getMiembromiembro()==$miembro){
      $this->addFlash("error","No puede borrar al miembro es lider");
    }else{
      $miembro->setMinisterioministerio(null);
      $em->flush();

      $this->addFlash("done","Usuario borrado de ministerio");  
    }


    $miembros = $this->getDoctrine()-> getRepository(Miembro::class)->findByMinisterioministerio($ministerio);

    return $this->render('administrador/detallesMinisterio.html.twig',array(
      'ministerio'=>$ministerio,
      'lider' => $lider,
      'miembros' => $miembros
    ));
  }


  public function tesoreriaAdministradorAction(){
    $caja = $this->getDoctrine()->getRepository(Caja::class)->findOneByIdcaja(1);
    $transacciones = $this->getDoctrine()->getRepository(Inoutcaja::class)->findByCajacaja($caja);
    $tipotransaccion=$this->getDoctrine()->getRepository(Tipotransaccion::class)->findAll();

    $validar=count($tipotransaccion);

    return $this->render("administrador/tesoreriaAdministrador.html.twig",array(
      'transacciones' => $transacciones,
      'caja' => $caja,
      'validar' => $validar
    ));
  }

  public function nuevaTransaccionAction(Request $request){
    $caja = $this->getDoctrine()->getRepository(Caja::class)->findOneByIdcaja(1);

    $inoutcaja = new Inoutcaja();
    $inoutcaja->setFecha(new \DateTime());

      $form=$this->createForm(InoutcajaType::class, $inoutcaja);
      $user = $this->get('security.token_storage')->getToken()->getUser();


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $em = $this->getDoctrine()->getManager();
        
        //$inoutcaja->setFecha(new \DateTime("now"));
        $inoutcaja->setCajacaja($caja);

        
        $em->persist($inoutcaja);
        $em->flush();
        if($inoutcaja->getTipotransacciontipotransaccion()->getTipo() == 1){
          $caja->setTotal($caja->getTotal()+$inoutcaja->getCantidad());
          $em->flush();
        }else{
          $caja->setTotal($caja->getTotal()-$inoutcaja->getCantidad());
          $em->flush();
        }
        
        
        return $this->redirectToRoute('tesoreriaAdministrador');
      }

       return $this->render('administrador/nuevaTransaccion.html.twig',array("form"=>$form->createView() ));
  }


  public function nuevoTipotransaccionAction(Request $request){

    $tipotransaccion = new Tipotransaccion();

      $form=$this->createForm(TipotransaccionType::class, $tipotransaccion);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($tipotransaccion);
        $em->flush();
        return $this->redirectToRoute('tesoreriaAdministrador');
      }

       return $this->render('administrador/nuevoTipotransaccion.html.twig',array("form"=>$form->createView() ));
  }

  public function reportesAdministradorAction(){
    return $this->render('administrador/reportesAdministrador.html.twig');
  }

  public function pdfMinisterioAction($id){
    $ministerio = $this->getDoctrine()->getRepository(Ministerio::class)->findOneByIdministerio($id);
    $miembros = $this->getDoctrine()->getRepository(Miembro::class)->findByMinisterioministerio($ministerio);
    $repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
  $query = $repositorylider->createQueryBuilder('l')
      ->where('l.ministerioministerio = :ministerio')
      ->andWhere('l.estado = 1')
      ->setParameter('ministerio', $ministerio)
      ->getQuery();

  $liderbusqueda = $query->getResult();
    $lider=null;

    if(count($liderbusqueda)>0){
      $lider=$liderbusqueda[0];
    }

    $snappy=$this->get("knp_snappy.pdf");
    $fecha_hoy=date("dmYHis");
    
    //$ubi="C:/wamp64/www/control/web/public/pdf/";
    $ubi="/home/Manuel1210/";
      //$ubi="/var/www/html/control/web/public/pdf/";

      $filename="rep_".$fecha_hoy.".pdf";
      // mostrar imagenes
      //$path = $request->server->get('DOCUMENT_ROOT');    // C:/wamp64/www/
      //$path = rtrim($path, "/");                         // C:/wamp64/www
      $html = $this->renderView('pdfformat/ministerioPdf.html.twig',
      array('miembros'=>$miembros,'lider'=>$lider));

      //GENERAR PDF SIN RESPUESTAS
      $response = new Response();
      $response->setContent($this->get('knp_snappy.pdf')->generateFromHtml($html,$ubi.$filename,
      array('lowquality' => false,
        'print-media-type' => true,
        'encoding' => 'utf-8',
        'page-size' => 'Letter',
        'margin-top'=> '1cm',
        'margin-bottom'=>'1cm',
        'margin-left'=> '2cm',
        'margin-right'=> '1cm',
        //'image-quality'=> '100',
        'header-font-size'=>7)));//guardamos el pdf

      $response->setStatusCode(Response::HTTP_OK);
      $response->headers->set('Content-Type', 'application/pdf');

      return $this->redirectToRoute('ministerio');
      //return $response;
      //return new Response("public/inventarioadmin/".$filename);
  }

  public function pdfpruebaAction(Request $request){
    $snappy= $this->get("knp_snappy.pdf");

    $html = $this->renderView("pdf1.html.twig", array(
      "title"=> "Awesome pdf Title"));

    $filename = "custom_pdf_from_twig";

    return new Response(
      $snappy->getOutputFromHtml($html),
      //status code
      200,
      array(
        'Content-Type'=>'application/pdf',
        'Content-Disposition'=>'inline; filename="'.$filename.'.pdf"'
      ));

  }

  public function reporteMiembrosAction(){
    $repository = $this->getDoctrine()->getRepository(Miembro::class);
      $miembros = $repository->findAll();
    return $this->render('administrador/reporteMiembros.html.twig',array(
      'miembros' => $miembros
    ));
  }

   //pdf de reportes de miembros
  public function pdfMiembrosAction(Request $request){
    $miembros = $this->getDoctrine()->getRepository(Miembro::class)->findByEstado(1);
    //$repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
    $snappy=$this->get("knp_snappy.pdf");
    $fecha_hoy=date("dmYHis");
    $ubi="C:\Users\Manuel\Documents";
    $filename="rep_".$fecha_hoy.".pdf";
    // mostrar imagenes
    // $path = $request->server->get('DOCUMENT_ROOT');    // C:/wamp64/www/
    //$path = rtrim($path, "/");                         // C:/wamp64/www
    $html = $this->renderView('pdfformat/pdfMiembros.html.twig',
      array('miembros'=>$miembros));
      //GENERAR PDF SIN RESPUESTAS
    $response = new Response();
    $response->setContent($this->get('knp_snappy.pdf')->generateFromHtml($html,$ubi.$filename,
      array('lowquality' => false,
        'print-media-type' => true,
        'encoding' => 'utf-8',
        'page-size' => 'Letter',
        'margin-top'=> '1cm',
        'margin-bottom'=>'1cm',
        'margin-left'=> '2cm',
        'margin-right'=> '1cm',
        //'image-quality'=> '100',
        'header-font-size'=>7)));//guardamos el pdf

    $response->setStatusCode(Response::HTTP_OK);
    $response->headers->set('Content-Type', 'application/pdf');

    return new PdfResponse(
      $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
        $filename
    );
  }

   //
  //funcion reporte  de presentacion 
  public function reportePresentacionesAction(){
    $repository= $this->getDoctrine()->getRepository(Presentacion::class);
    $presentacion= $repository->findAll();
    return $this->render('administrador/reportePresentaciones.html.twig',array(
    'Presentacion'=> $presentacion
    ));
  }

  //imprimir reporte presentacion 
  public function pdfPresentacionesAction(Request $request){
    $presentacion = $this->getDoctrine()->getRepository(Presentacion::class)->findAll();
  
    $snappy=$this->get("knp_snappy.pdf");
    $fecha_hoy=date("dmYHis");
  
    $ubi="C:\Users\Manuel\Documents";
    $filename="rep_".$fecha_hoy.".pdf";

    $html = $this->renderView('pdfformat/pdfPresentaciones.html.twig',
      array('Presentacion'=>$presentacion));
      //GENERAR PDF SIN RESPUESTAS
    $response = new Response();
    $response->setContent($this->get('knp_snappy.pdf')->generateFromHtml($html,$ubi.$filename,
      array('lowquality' => false,
        'print-media-type' => true,
        'encoding' => 'utf-8',
        'page-size' => 'Letter',
        'margin-top'=> '1cm',
        'margin-bottom'=>'1cm',
        'margin-left'=> '2cm',
        'margin-right'=> '1cm',
        //'image-quality'=> '100',
        'header-font-size'=>7)));//guardamos el pdf
    $response->setStatusCode(Response::HTTP_OK);
    $response->headers->set('Content-Type', 'application/pdf');

    return new PdfResponse(
      $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
        $filename
    );
  }



  public function reporteMiembrosbautizadosAction(Request $request){

     $form=$this->createFormBuilder()
      ->add('fechainicial',DateType::class, array(
        // render as a single text box
       // 'widget' => 'single_text',
    // this is actually the default format for single_text
       'format'      => 'yyyy-MM-dd', // you need to have 'y', 'M' and 'd' here
       'years'       => range(date('Y'), date('Y') - 30, -1),
        'attr'=>array('class'=>'form-control'),
        ))
      ->getForm();
       $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $fecha=$form->get('fechainicial')->getData();
        $anio=$fecha->format('Y');
        $fechaini=new \DateTime($anio."-01-01 00:00:00");
        $fechafin=new \DateTime($anio."-12-31 23:59:59");

        $repository = $this->getDoctrine()->getRepository(Bautizo::class);

        // createQueryBuilder() automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.fecha >= :fecha1')
            ->andWhere('p.fecha <= :fecha2')
            ->setParameter('fecha1', $fechaini)
            ->setParameter('fecha2', $fechafin)
            ->orderBy('p.fecha', 'ASC')
            ->getQuery();
        $bautizos = $query->getResult();

        //return $this->render('administrador/mostrarReportebautizados.html.twig',array(
        return $this->render('administrador/reporteMiembrosbautizadosresultbusqueda.html.twig',array(
          'bautizos' => $bautizos
        ));
    }
    //return $this->render('administrador/reporteMiembrosbautizados.html.twig',array(
    return $this->render('administrador/reporteMiembrosbautizados.html.twig', array(
      'form'=>$form->createView()
    ));
  }
//////////////////////////////////////////////////////////////////////

  public function reporteMinisteriosadministradorAction(){

    return $this->render('administrador/reporteMinisteriosadministrador.html.twig');
  }

  public function reporteLideresadministradorAction(){
    return $this->render('administrador/reporteLideresadministrador.html.twig');
  }

  
  //public function reportePresentacionesAction(){ 
    
    //return $this->render('administrador/reportePresentaciones.html.twig');
  //}


  public function fechaReportetesoreriaadminAction(Request $request){
    $form=$this->createFormBuilder()
            ->add('fechainicial',DateType::class, array(
                // render as a single text box
                'widget' => 'single_text','label'=>'Fecha Inicio','attr'=>array('class'=>'form-control'),
                ))
            ->add('fechafinal',DateType::class, array(
                // render as a single text box
                'widget' => 'single_text','label'=>'Fecha Final','attr'=>array('class'=>'form-control'),
                ))
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Ingresos' => 1,
                    'Salidas' => 2,
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fecha1=$form->get('fechainicial')->getData();
            $fecha2=$form->get('fechafinal')->getData();
            $tipo=$form->get('tipo')->getData();
            //$t1 = $this->getDoctrine()->getRepository(Tipotransaccion::class)->findOneByTipo(2);

            //SELECT * FROM `inoutcaja` INNER JOIN tipotransaccion ON tipotransaccion.idtipotransaccion = inoutcaja.tipotransaccion_idtipotransaccion WHERE tipotransaccion.tipo = 1;
            if($fecha1<$fecha2){
                $em = $this->getDoctrine()->getManager();

                 $transaccionesquery = $em->createQuery(
                  'SELECT i FROM  AppBundle:Inoutcaja i
                  join AppBundle:Tipotransaccion t
                  where t = i.tipotransacciontipotransaccion
                  and t.tipo = :tipo
                  and i.fecha >= :fechainicio
                  and i.fecha <= :fechafinal')
                  ->setParameter('fechainicio', $fecha1)
                  ->setParameter('fechafinal', $fecha2)
                  ->setParameter('tipo', $tipo);

                  $transacciones= $transaccionesquery->getResult();


                $caja = $this->getDoctrine()->getRepository(Caja::class)->findOneByIdcaja(1);
                /*$repository=$this->getDoctrine()->getRepository(Inoutcaja::class);
                $query = $repository->createQueryBuilder('f')
                    ->where('r.tipo = 1')
                    ->where('f.fecha >= :fechainicio')
                    ->andWhere('f.fecha <= :fechafinal')
                    ->andWhere('f.tipotransacciontipotransaccion.tipo = 1')
                    ->setParameter('fechainicio', $fecha1)
                    ->setParameter('fechafinal', $fecha2)
                    //->setParameter('tipo',$t1)
                    ->orderBy('f.fecha', 'ASC')
                    ->getQuery();

                $transacciones = $query->getResult();*/
            }

            return $this->render('administrador/resultadoReportetesoreriaadmin.html.twig',array(
                'fecha1'=>$fecha1,
                'fecha2'=>$fecha2,
                'transacciones'=>$transacciones,
                'caja'=>$caja
            ));
        }

      return $this->render('administrador/fechaReportetesoreriaadmin.html.twig',
      array('form'=>$form->createView()));

    //return $this->render('administrador/fechaReportetesoreriaadmin.html.twig');
  }

  public function mostrarReportetesoreriaadminAction(Request $request){

  }




  public function pdfMiembrosbautizadosAction(request $request){
    $bautizos = $this->getDoctrine()->getRepository(Bautizo::class);
    //$repositorylider = $this->getDoctrine()->getRepository(Liderministerio::class);
  
    $snappy=$this->get("knp_snappy.pdf");
    $fecha_hoy=date("dmYHis");
  
    $ubi="C:\Users\Manuel\Documents";

    $filename="rep_".$fecha_hoy.".pdf";

    $html = $this->renderView('pdfformat/pdfMiembrosbautizados.html.twig',
      array('bautizos'=>$bautizo));

      //GENERAR PDF SIN RESPUESTAS
    $response = new Response();
    $response->setContent($this->get('knp_snappy.pdf')->generateFromHtml($html,$ubi.$filename,
      array('lowquality' => false,
        'print-media-type' => true,
        'encoding' => 'utf-8',
        'page-size' => 'Letter',
        'margin-top'=> '1cm',
        'margin-bottom'=>'1cm',
        'margin-left'=> '2cm',
        'margin-right'=> '1cm',
        //'image-quality'=> '100',
        'header-font-size'=>7)));//guardamos el pdf

    $response->setStatusCode(Response::HTTP_OK);
    $response->headers->set('Content-Type', 'application/pdf');

    return new PdfResponse(
      $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
        $filename
    );

  }

}
