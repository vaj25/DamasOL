<?php
// src/AppBundle/Controller/LoginController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller {
    
    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request) {
        
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'users/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );

    }

    /**
     * @Route("/login2/success", name="login_route2")
     */
    public function login2Action(Request $request) {
        
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'users/login2.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
                )
        );

    }

}
