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

class PartesCuerpoController extends Controller
{
    //-------------------------------------REGISTRO USUARIO----------------------------------------------

    /**
     * @Route("/desaparecido/partesCuerpo", name="partesCuerpo_register")
     */
    public function addParteCuerpoAction(Request $peticion)
    {
        $formulario = $this->createForm(PartesCuerpoFormType::class);

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
            return $this->redirectToRoute('user_perfil');
        }

        return $this->render('desaparecido/partesCuerpo.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

}
