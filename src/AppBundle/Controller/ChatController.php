<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChatController extends Controller
{
    /**
     * @Route("/chat", name="chat")
     */

    public function indexAction(Request $request)
    {
        $var  = "Hola mundo";
        
        // replace this example code with whatever you need
        return $this->render('default/chat.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            
        ]);
    }

    /**
     * @Route("/grupoa-chat", name="grupoa")
     */
    public function chatAction() {
        return $this->render('default/chat.html.twig');
    }
}