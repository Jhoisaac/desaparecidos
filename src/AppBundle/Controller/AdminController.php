<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Discapacidad;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\Partes_Cuerpo;
use AppBundle\Entity\Rasgos_Dist;
use AppBundle\Entity\Rol;
use AppBundle\Entity\Solicitud;
use AppBundle\Entity\Tipo_Org;
use AppBundle\Entity\Usuario;
use AppBundle\Form\AdminFormType;
use AppBundle\Form\SolicitudFormType;
use AppBundle\Form\UsuarioFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin/cpanel", name="admin_inicio")
     */
    public function dashboardAction()
    {
        return $this->render('admin/controlpanel.html.twig');
    }

    /**
     * @Route("/admin/seleccion", name="admin_seleccion", options={"expose"=true})
     */
    public function seleccionAction(Request $request)
    {
        if ($request->isXMLHttpRequest()){
            $mensaje = '';
            $value = $request->get('value');
            /*admin/dashboard*/
            if($value == 1){

                $template = $this->render('admin/dashboard.html.twig')
                    ->getContent();
            }/*admin/perfil
            else if($value == 2){
                $formulario = $this->createForm(AdminFormType::class, $this->getUser());

                $template = $this->render('admin/perfilajax.html.twig', [
                    'formulario' => $formulario->createView()
                ])
                    ->getContent();
            }/*admin/organizaciones*/
            else if($value == 3){

                $em=$this->getDoctrine()->getManager();
                $organizacion=$em->getRepository(Organizacion::class)
                    ->findAll();

                $template = $this->render('admin/organizaciones.html.twig', [
                    'organizaciones' => $organizacion
                ])
                    ->getContent();
            }/*admin/usuarios*/
            else if($value == 4){

                $em = $this->getDoctrine()->getManager();
                $usuario = $em->getRepository(Usuario::class)
                    ->findAll();

                $template = $this->render('admin/usuarios.html.twig', [
                    'usuarios' => $usuario
                ])
                    ->getContent();
            }/*admin/desaparecidos*/
            else if($value == 5){

                $template = $this->render('admin/desaparecidos.html.twig')
                    ->getContent();
            }/*admin/mapa*/
            else if($value == 6){

                $template = $this->render('admin/mapa.html.twig')
                    ->getContent();
            }/*admin/solicitudes*/
            else if($value == 7){
                $em=$this->getDoctrine()->getManager();
                $solicitud=$em->getRepository(Solicitud::class)
                    ->findAll();

                $template = $this->render('admin/solicitudes.html.twig', [
                    'solicitudes' => $solicitud
                ])
                    ->getContent();
            }/*admin/EncargadoDatos*/
            else if($value == 8){
                $template = $this->render('admin/generalidades.html.twig.html.twig')
                    ->getContent();
            }

            // Enviar la respuesta codificada como json
            return new JsonResponse([
                'main_content_html' => $template,
                'mensaje' => $mensaje
            ]);
        }

        return new Response('Acción no permitida!', 400);
    }

    /**
     * @Route("/admin/editar", name="admin_edit", options={"expose"=true})
     */
    public function editAction(Request $request)
    {
        if (!$request->isXMLHttpRequest()){
            return new Response('Acción no permitida!', 400);
        }

        $mensaje = '';

        $admin = $this->getUser();
        $formulario = $this->createForm(AdminFormType::class, $admin);


        if($admin==null){
            $ms="El usuario con id ".$admin->getId()." NO EXISTE..!";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute('index');
        }

        //Solo maneja datos enviados por POST
        $formulario->handleRequest($request);
        if($formulario->isSubmitted() && $formulario->isValid()){
            /** @var Usuario $user */
            //$usuario = $formulario->getData();
            //Guarda el objeta en la bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();

            $this->addFlash('success', 'Datos actualizados correctamente!');
            $mensaje = 'Datos actualizados correctamente!';
            return $this->redirectToRoute("index");

            // Enviar la respuesta codificada como json
            /*$template = $this->render('admin/perfilajax.html.twig', [
                'formulario' => $formulario->createView()
            ])
                ->getContent();*/
        }

        $template = $this->render('admin/perfilajax.html.twig', [
            'formulario' => $formulario->createView()
        ])
            ->getContent();

        return new JsonResponse([
            'main_content_html' => $template,
            'formulario' => $formulario,
            'mensaje' => $mensaje
        ]);
    }

    /**
     * @Route("/admin/perfil", name="admin_perfil")
     */
    public function perfilAction(Request $request)
    {
        $admin = $this->getUser();
        $formulario = $this->createForm(AdminFormType::class, $admin);

        if($admin==null){
            $ms="El usuario con id ".$admin->getId()." NO EXISTE..!";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute('index');
        }

        //Solo maneja datos enviados por POST
        $formulario->handleRequest($request);
        if($formulario->isSubmitted() && $formulario->isValid()){
            /** @var Usuario $user */
            //$usuario = $formulario->getData();

            dump($admin); die();
            //Guarda el objeta en la bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();

            $this->addFlash('success', 'Datos actualizados correctamente!');

            //return $this->redirectToRoute("admin_perfil");
        }

        return $this->render('admin/perfil.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

    /**
     * @Route("/admin/organizacion", name="admin_organizacion")
     */
    public function organizacionAction()
    {
        $rol= $this->rolAllAction();
        $em=$this->getDoctrine()->getManager();
        $organizacion=$em->getRepository(Organizacion::class)
            ->findAll();

        return $this->render('admin/organizaciones.html.twig', [
            'organizaciones'=>$organizacion,
            'rol'=>$rol
        ]);

    }


    /**
     * @Route("/admin/usuarios", name="admin_usuarios")
     */
    public function usuariosAction()
    {
        $rol= $this->rolAllAction();
        $usuario=new usuario();
        $em=$this->getDoctrine()->getManager();
        $usuario=$em->getRepository(Usuario::class)
            ->findAll();
        //dump($rol); dump($usuario); die();
       return $this->render('admin/usuarios.html.twig', [
            'usuarios'=>$usuario,
           'rol'=>$rol
        ]);
    }
    public function rolAllAction()
    {
        $em=$this->getDoctrine()->getManager();
        $rol=$em->getRepository(Rol::class)
            ->findAll();

        return $rol;
    }

    /**
     * @Route("/admin/desaparecidos", name="admin_desaparecidos")
     */
    public function desaparecidosAction()
    {
        return $this->render('admin/desaparecidos.html.twig');
    }

    /**
     * @Route("/admin/mapa", name="admin_mapa")
     */
    public function mapaAction()
    {
        return $this->render('admin/mapa.html.twig');
    }

    /**
    * @Route("/admin/datosEncargado", name="datos_encargado")
     */
    public function datosEncargadoAcction()
    {
        return $this->render('generalidades.html.twig');
    }

    /**
     * @Route("/admin/tipografia", name="admin_tipografia")
     */
    public function tipografiaAction()
    {
        return $this->render('admin/tipografia.html.twig');
    }

    /*Rasgos distintivos */

    /**
     * @Route("/admin/partes-cuerpo", name="rasgos_cuerpo")
     */

    public function rasgosAction()
    {
        return $this->render('admin/admin-rasgos.html.twig',array());
    }

    /**
     * @Route("/solicitud/eliminar", name="delete_solicitud",  options={"expose"=true})
     */

    public function deletedSolicitudAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $id = $request->get('id');

            $repository = $this->getDoctrine()->getRepository('AppBundle:Solicitud');
            $solicitud = $repository->findOneById($id);
            $em = $this->getDoctrine()->getManager();
            $solicitud->setEstado(0);
            $em->persist($solicitud);
            $em->flush();

            $lista_solicitud = $repository->findAll();

            $lista_solicitud_html = $this->render('admin/solicitudes.html.twig', [
                'solicitudes'=> $lista_solicitud
            ])->getContent();

            return new JsonResponse(array(
                    'mensaje' => 'Solicitud Eliminada!',
                    '$lista_solicitud_html' => $lista_solicitud_html
                )
            );


        }

        return new Response('Acción no permitida!', 400);
    }

}