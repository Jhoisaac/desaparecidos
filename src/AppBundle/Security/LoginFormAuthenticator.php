<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 25/01/17
 * Time: 9:20
 */

namespace AppBundle\Security;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Usuario;
use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $formFactory;
    private $em;
    private $router;
    private $passwordEncoder;
    private $user;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
        /*Login por Modal*/
        $isLoginSubmitModal = $request->getPathInfo() == '/' && $request->isMethod('POST');
        /*Login por Redireccion*/
        $isLoginSubmit = $request->getPathInfo() == '/usuario/login' && $request->isMethod('POST');
        if (!$isLoginSubmitModal && !$isLoginSubmit){
            return;
        }

        $formulario = $this->formFactory->create(LoginForm::class);
        $formulario->handleRequest($request);

        $datos = $formulario->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $datos['_username']
        );

        return $datos;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];

        if ($username === 'admin@gmail.com'){
            return $this->em->getRepository('AppBundle:Admin')
                ->findOneBy(['email' => $username]);
        }
        else{
            return $this->em->getRepository('AppBundle:Usuario')
                ->findOneBy(['email' => $username]);
        }

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $this->user = $user;

        $password = $credentials['_password'];

        if ($this->passwordEncoder->isPasswordValid($user, $password)) {
            return true;
        }

        return false;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        //dump($this->user); die();

        $roles = $this->user->getRoles();

        if (in_array('ROLE_FAMILIAR', $roles)){

            return $this->router->generate('user_perfil');
        }
        else if (in_array('ROLE_ENCARGADO', $roles)){

            return $this->router->generate('encargado_home');
        }
        else if (in_array('ROLE_ADMIN', $roles)){

            return $this->router->generate('admin_inicio');
        }
        else{
            return $this->router->generate('index');
        }
    }
}