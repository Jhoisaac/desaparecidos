<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @Route("/usuario/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // Obtiene el error del login si existe alguno
        $error = $authenticationUtils->getLastAuthenticationError();
        // Ultimo username ingresado por el usuario
        $lastUsername = $authenticationUtils->getLastUsername();

        $formulario = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(':security:login.html.twig', [
            'formulario' => $formulario->createView(),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/usuario/login/modal", name="login_modal", options={"expose"=true})
     */
    public function loginModalAction(Request $request)
    {
        // verifica que solo se puede acceder a este controlador mediante una llamada ajax
        if ($request->isXMLHttpRequest()){
            $authenticationUtils = $this->get('security.authentication_utils');
            // Obtiene el error del login si existe alguno
            $error = $authenticationUtils->getLastAuthenticationError();
            // Ultimo username ingresado por el usuario
            $lastUsername = $authenticationUtils->getLastUsername();

            $formulario = $this->createForm(LoginForm::class,[
                '_username' => $lastUsername,
            ]);

            $template = $this->render('security/loginmodal.html.twig', [
                'formulario' => $formulario->createView(),
                'error' => $error
            ])
                ->getContent();

            // Enviar la respuesta codificada como json
            return new JsonResponse(array(
                    'login_modal_html' => $template
                )
            );
        }

        return new Response('Acción no permitida!', 400);
    }

    /**
     * @Route("/usuario/logout", name="security_logout")
     */
    public function logoutAction()
    {
        /*el logout lo hace Symfony automáticamente, pero es necesario
        definir una ruta /logout. Por eso existe este método vacío.*/
        throw new \Exception('Esto no deberia ser alcanzable');
    }
}
