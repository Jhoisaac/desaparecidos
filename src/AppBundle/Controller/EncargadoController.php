<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\DesaparecidoFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EncargadoController extends Controller
{
    /**
     * @Route("/encargado", name="encargado_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Usuario::class)
            ->find($this->getUser());

        //dump($user); die();


        return $this->render('encargado/home.html.twig', [
            'usuario' => $user
        ]);
    }

    /**
     * @Route("/encargado/perfil1", name="encargado_list")
     */
    public function allEncargadoAction()
    {
        $em=$this->getDoctrine()->getManager();
        $encargado=$em->getRepository('AppBundle:Usuario')->findAll();
        return $this->render('encargado/home.html.twig',array('Usuario'=>$encargado));
    }


    /**
     * @Route("/encargado/perfil", name = "encargado_perfil")
     */
    public function perfilAction()
    {
        $formulario = $this->createForm(DesaparecidoFormType::class);


        return $this->render(
            'encargado/perfil.html.twig', [
                'perfil' => $formulario
            ]
        );
    }
}


