<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Discapacidad;
use AppBundle\Form\DiscapacidadFormType;
use AppBundle\Form\RagosDistFormType;
use AppBundle\Form\PartesCuerpoFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RasgosDistintivosController extends Controller
{

    /**
     * @Route("/desaparecido/rasgoDistintivo", name="rasgoDis_register")
     */
    public function addRasgoAction(Request $peticion)
    {
        $formulario = $this->createForm(RagosDistFormType::class);

        //Solo maneja datos enviados por POST
        $formulario->handleRequest($peticion);
        if($formulario->isSubmitted() && $formulario->isValid()){
            //dump($formulario->getData());die; //Para comprobar que datos se han llenado
            $usuario = $formulario->getData();
            //Guarda el objeta en la bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $this->addFlash('success', 'Registro Existoso!');

            //Redirecciona a la pagina del perfil del usuario que se acaba de registrar
            return $this->redirectToRoute('partesCuerpo_register');
        }

        return $this->render('desaparecido/rasgo-distintivos.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

}