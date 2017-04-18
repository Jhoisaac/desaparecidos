<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Desaparecido;

use AppBundle\Entity\Organizacion;
use AppBundle\Entity\Rol;
use AppBundle\Entity\RolxUsuario;
use AppBundle\Entity\Solicitud;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioFormType;
use AppBundle\Form\SolicitudFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsuarioController extends Controller
{
    //-------------------------------------REGISTRO USUARIO----------------------------------------------

    /**
     * @Route("/usuario/registro", name="user_register")
     */
    public function registroAction(Request $peticion)
    {
        $formulario = $this->createForm(UsuarioFormType::class);

        //Solo maneja datos enviados por POST
        $formulario->handleRequest($peticion);
        if($formulario->isSubmitted() && $formulario->isValid()){
            //dump($formulario->getData());die; //Para comprobar que datos se han llenado
            /** @var Usuario $user */
            $usuario = $formulario->getData();



            /** @var Organizacion $organiz */
            $organiz = $usuario->getOrganiz();

            /** @var Rol $rol */
            $rol = $usuario->getRol();

            $role = 'ROLE_' . $rol;
            $roles[]  = strtoupper($role);
            $usuario->setRoles($roles);

            /** @var RolxUsuario $user */
            $rolxuser = new RolxUsuario();
            $rolxuser->setUsuario($usuario);
            $rolxuser->setRol($rol);
            if($organiz)
                $rolxuser->setOrganizacion($organiz);

            //Guarda el objeta en la bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->persist($rolxuser);
            if($organiz)
                $em->persist($organiz);
            $em->flush();

            $this->addFlash('success', 'Registro Existoso!');

            //Redirecciona a la pagina d login del usuario que se acaba de registrar
            return $this->redirectToRoute('security_login');
        }

        return $this->render('usuario/registro.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

    //--------------------------------------EDITAR USUARIO-----------------------------------------------

    /**
     * @Route("/usuario/editar/", name="user_edit")
     */
    public function editAction(Request $peticion)
    {
        $usuario=$this->getUser();
        //dump($usuario);
        //die();
        $em=$this->getDoctrine()->getManager();

        //Creamos el formulario nuevo

        $formulario = $this->createFormBuilder($usuario)
            ->add('nombre')
            ->add('apellido')
            ->add('cedula')
            ->add('fchNaci', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
            ->add('telefono')
            ->add('celular')
            ->add('email')
            ->add('Guardar cambios',SubmitType::class)
            ->getForm();

        $usuario->setNombre($formulario->get('nombre')->getData());
        $usuario->setApellido($formulario->get('apellido')->getData());
        $usuario->setCedula($formulario->get('cedula')->getData());
        $usuario->setFchNaci($formulario->get('fchNaci')->getData());
        $usuario->setTelefono($formulario->get('telefono')->getData());
        $usuario->setCelular($formulario->get('celular')->getData());
        $usuario->setEmail($formulario->get('email')->getData());



        //Esto solo sucedera en POST
        $formulario->handleRequest($peticion);

        //Bucle if que permite verificar si el form es valido y correcto
        if($formulario->isSubmitted() && $formulario->isValid()){
            //$student=$form->getData(); //Tomo los datos del form

            //guardando solicitud
            $em=$this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();


            //enviando mensaje
            $this->addFlash('success', 'Cambios registrados');

            return $this->redirectToRoute("user_perfil");

        }



        return $this->render('usuario/editar.html.twig',array('usuario'=>$usuario, 'formulario'=>$formulario->createView()));
    }
    //---------------------------------------------------------------------------------------------------

    //------------------------------------LISTAR USUARIOS------------------------------------------------
    private function userAll(){
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository('AppBundle:Usuario')->findAll();
        return $user;
    }

    //---------------------------------------MI PERFIL----------------------------------------------------
    /**
     * @Route("/usuario/perfil", name="user_perfil")
     */
    public function verperfilAction(Request $peticion)
    {

        $user = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $perfil=$em->getRepository(Usuario::class)
            ->findAll();
        return $this->render('usuario/perfil.html.twig', [
            'usuario_perfil'=>$perfil,'user'=>$user
        ]);

        return $this->render('usuario/perfil.html.twig')
            ;
    }

    //---------------------------------------------------------------------------------------------------

    //----------------------------------------------BUSCAR-----------------------------------------------
    /**
     * @Route("/usuario/buscar", name="user_buscar")
     */
    public function buscarAction(Request $peticion)
    {

        $repository = $this->getDoctrine()->getRepository('AppBundle:Desaparecido');

        $form =$this->createFormBuilder()
            ->add('cedula',TextType::class)
            ->add ('Buscar',SubmitType::class)->getForm();

        $form->handleRequest($peticion);
        $ced=$form->get('cedula')->getData();


        $em = $this->getDoctrine()->getManager();

        $desaparecido=$em->getRepository('AppBundle:Desaparecido')->findBy(
            array(
                'cedula'=>$ced)
        );


        $em=$this->getDoctrine()->getManager();
        $em->flush();



        return $this->render('usuario/buscar.html.twig', array('desaparecido'=>$desaparecido, 'form' => $form->createView()));

    }
    //--------------------------------------NUEVA SOLICITUD----------------------------------------------

    /**
     * @Route("/usuario/solicitud", name="user_solicitud")
     */
    public function solicitarAction(Request $peticion)
    {

        $usuario=$this->getUser();

        //Creamos el formulario
        $solicitud= new Solicitud();
        $form=$this->createFormBuilder($solicitud)
            ->add('asunto')
            ->add('descripcion')
            ->add('Enviar',SubmitType::class)
            ->getForm();

        $usuario=$this->getUser();
        $solicitud->setUsuario($usuario);
        $solicitud->setEstado($usuario);
        //Esto solo sucedera en POST
        $form->handleRequest($peticion);

        //Bucle if que permite verificar si el form es valido y correcto
        if($form->isSubmitted() && $form->isValid()){

            //guardando solicitud
            $em=$this->getDoctrine()->getManager();
            //dump($solicitud);
            //die();
            $em->persist($solicitud);
            $em->flush();

            //enviando mensaje
            $this->addFlash('success', 'Solicitud registrada');

            return $this->redirectToRoute("user_listar");

        }

        return $this->render('usuario/solicitud.html.twig',array('solicitud'=>$solicitud, 'form'=>$form->createView()));
    }


    //----------------------------------------------LISTAR MIS SOLICITUDES-------------------------------------------
    /**
     * @Route("/usuario/listar", name="user_listar")
     */
    public function listarAction(Request $peticion)
    {


        $usuario=$this->getUser();

        $em=$this->getDoctrine()->getManager();

        $solicitudes=$em->getRepository('AppBundle:Solicitud')->findBy(
            array(
                'usuario'=>$usuario)
        );


        $em=$this->getDoctrine()->getManager();
        $em->flush();

        return $this->render('usuario/list.html.twig',array('solicitud'=>$solicitudes));


    }
    //---------------------------------------------------------------------------------------------------

    //------------------------------LISTAR TODAS LAS SOLICITUDES-----------------------------------------

    private function listAll(){
        $em=$this->getDoctrine()->getManager();
        $solicitud=$em->getRepository('AppBundle:Solicitud')->findAll();
        return $solicitud;
    }

    //---------------------------------------------------------------------------------------------------

    //-----------------------------------ELIMINAR SOLICITUDES--------------------------------------------
    /**
     * @Route("/usuario/listar/delete/{id}", name="delete")
     */
    public function deleteAction(Request $peticion,$id)
    {
        $solicitud=$this->listAll();
        $em=$this->getDoctrine()->getManager();
        $solicitud=$em->find('AppBundle:Solicitud', $id); //Obtiene el objeto solicitud que se desea elliminar

        //Valida si existe la solicitud
        if(!$solicitud){
            $ms="La solicitud  con id ".$id." NO EXISTE";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("user_listar");
        }else{
            try{
                $solicitud=$em->find('AppBundle:Solicitud', $id);//
                $form = $this->createFormBuilder($solicitud)
                    ->add('asunto')
                    ->add('descripcion')
                    ->add('Si',SubmitType::class)
                    ->getForm();
                $usuario=$this->getUser();
                $solicitud->setUsuario($usuario);
                $solicitud->setEstado($usuario);



                $form->handleRequest($peticion);

                if($form->isSubmitted() && $form->isValid()){
                    $em->remove($solicitud);
                    $em->flush();
                    $ms="Solicitud eliminada con id ".$id;
                    $this->addFlash('success',"$ms");
                    return $this->redirectToRoute("user_listar");
                }
            }catch (\PDOException $exception){
                $this->addFlash('error',"Error!, no puede eliminar");
                return $this->redirectToRoute("user_listar");
            }

            return $this->render('usuario/solicitud.html.twig',array('solicitud'=>$solicitud, 'form'=>$form->createView()));
        }
    }

    //---------------------------------------------------------------------------------------------------

    //---------------------------------------EDITAR SOLICITUD--------------------------------------------

    /**
     * @Route("/usuario/listar/editar/{id}", name="edit")
     */
    public function editSolAction(Request $peticion,$id)
    {
        $solicitud=$this->listAll();
        $em=$this->getDoctrine()->getManager();
        $solicitud=$em->find('AppBundle:Solicitud', $id); //Obtiene el objeto solicitud que se desea modificar

        //Valida si el estudiante existe
        if($solicitud==null){
            $ms="La solicitud con id ".$id." NO EXISTE";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("user_listar");
        }else{
            try{
                $solicitud=$em->find('AppBundle:Solicitud', $id);

                $form = $this->createFormBuilder($solicitud)
                    ->add('asunto')
                    ->add('descripcion')
                    ->add('Guardar Cambios',SubmitType::class)
                    ->add('Cancelar',SubmitType::class)
                    ->getForm();
                $usuario=$this->getUser();
                $solicitud->setUsuario($usuario);
                $solicitud->setEstado($usuario);



                $form->handleRequest($peticion);


                if($form->isSubmitted() && $form->isValid()){

                    $em=$this->getDoctrine()->getManager();
                    $em->persist($solicitud);
                    $em->flush();
                    $ms="Solicitud  modificada con id ".$id;
                    $this->addFlash('success',"$ms");
                    return $this->redirectToRoute("user_listar");
                }
            }catch (\PDOException $exception){
                $this->addFlash('error',"Error!, no puede editar");
                return $this->redirectToRoute("user_listar");
            }
        }

        return $this->render('usuario/solicitud.html.twig',array('solicitud'=>$solicitud, 'form'=>$form->createView()));
    }

    //---------------------------------------------------------------------------------------------------
    //-----------------------------------------LISTAR DESAPARECIDOS--------------------------------------

    private function listDesaAll(){
        $em=$this->getDoctrine()->getManager();
        $desaparecido=$em->getRepository('AppBundle:Desaparecido')->findAll();
        return $desaparecido;
    }
    //---------------------------------------------------------------------------------------------------

    //----------------------------------------C O N T A C T O S------------------------------------------
    /**
     * @Route("/contactos", name="all_contactos")
     */
    public function contactosAction(Request $peticion)
    {
        return $this->render('contactos/contactos.html.twig');
    }
    //---------------------------------------------------------------------------------------------------

    //--------------------------------P R E G UN T A S  F R E C U E N T E S------------------------------
    /**
     * @Route("/preguntas", name="all_preguntas")
     */
    public function preguntasAction(Request $peticion)
    {
        return $this->render('contactos/preguntasFrecuentes.html.twig');
    }
    //---------------------------------------------------------------------------------------------------




}