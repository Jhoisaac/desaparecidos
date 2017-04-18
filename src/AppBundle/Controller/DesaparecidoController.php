<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Desaparecido;
use AppBundle\Form\DesaparecidoFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DesaparecidoController extends Controller
{
    /**
     * @Route("/desaparecido/registroDesap", name="desaparecido_register")
     */
    public function addDesaparecidoAction(Request $peticiond)
    {
        $formulariod = $this->createForm(DesaparecidoFormType::class);

        //Solo maneja datos enviados por POST
        $formulariod->handleRequest($peticiond);
        if($formulariod->isSubmitted() && $formulariod->isValid()){

            $em=$this->getDoctrine()->getManager();
            $usuario=$this->getUser();
            $rolxusuario=$em->getRepository('AppBundle:RolxUsuario')->findBy(
                array(
                    'usuario'=>$usuario)
            );

            $formulariod = $this->createForm(DesaparecidoFormType::class);
            //Solo maneja datos enviados por POST
            $formulariod->handleRequest($peticiond);
            if($formulariod->isSubmitted() && $formulariod->isValid()) {

                $desaparecido = $formulariod->getData();
//            $desaparecido->setRolxUsuario();
//            dump($desaparecido);die; //Para comprobar que datos se han llenado
                //Dar formato a la  Foto
                $img = $formulariod['foto']->getData();
                $ext = $img->guessExtension();
                $file_name = time() . "." . $ext;
                //Subir la foto al servidor
                $img->move("Desaparecidos", $file_name);
                $desaparecido->setRutafoto($file_name);
                $desaparecido->setRolxuser($rolxusuario[0]);
                //dump($desaparecido);die;
                //Guarda el objeta en la bdd
                $em = $this->getDoctrine()->getManager();
                $em->persist($desaparecido);
                $em->flush();
            }

            $this->addFlash('success', 'Registro Existoso!');

            //Redirecciona a la pagina del perfil del usuario logeado
            return $this->redirectToRoute('user_perfil');  //Poner el url del perfil usuario
        }

        return $this->render('desaparecido/registro-desaparecido.html.twig', array(
            'formulariod' => $formulariod->createView()
        ));
    }


}

