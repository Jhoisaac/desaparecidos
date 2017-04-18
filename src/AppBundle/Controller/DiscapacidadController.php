<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Discapacidad;
use AppBundle\Form\DiscapacidadFormType;
use AppBundle\Form\UsuarioFormType;
use AppBundle\Form\SolicitudFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DiscapacidadController extends Controller
{

    /**
     * @Route("/desaparecido/discapacidad", name="disca_register")
     */
    public function addDiscapacidadAction(Request $peticion)
    {

        //Creamos el formulario
        $discapacidad= new Discapacidad();
        $form=$this->createFormBuilder($discapacidad)
            ->add('nombre',EntityType::class,array(
                'label'=>'Elija la Discapacidad',
                'class' => 'AppBundle:Discapacidad',
                'choice_label' => 'nombre',
            ))
            ->add('Registrar',SubmitType::class)
            ->getForm();

        $discapacidad->setEstadoDiscapacidad(1);
        //Esto solo sucedera en POST
        $form->handleRequest($peticion);

        //Bucle if que permite verificar si el form es valido y correcto
        if($form->isSubmitted() && $form->isValid()){

            //guardando solicitud
            $em=$this->getDoctrine()->getManager();
            //dump($Discapacidad);
            //die();
            $em->persist($discapacidad);
            $em->flush();

            //enviando mensaje
            $this->addFlash('success', 'Solicitud registrada');

            return $this->redirectToRoute("partesCuerpo_register");

        }

        return $this->render('desaparecido/registro-discapacidad.html.twig',array('form'=>$form->createView()));
    }



}