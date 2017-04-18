<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizController extends Controller
{
    /**
     * @Route("/organizacion/eliminar", name="delete_organiz", options={"expose"=true})
     */
    public function deleteAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $id = $request->get('id');

            $repository = $this->getDoctrine()->getRepository('AppBundle:Organizacion');
            $organiz = $repository->findOneById($id);
            $em = $this->getDoctrine()->getManager();
            $organiz->setEstado(0);
            //$em->remove($organiz);
            $em->persist($organiz);
            $em->flush();
            // obtener la lista de comentarios actualizada
            $lista_organizs = $repository->findAll();

            $lista_organizs_html = $this->render('admin/organizaciones.html.twig', [
                'organizaciones'=> $lista_organizs
            ])->getContent();

            return new JsonResponse(array(
                    'mensaje' => 'Organizacion Eliminada!',
                    'lista_organizs_html' => $lista_organizs_html
                )
            );
        }

        return new Response('Acción no permitida!', 400);
    }
}
