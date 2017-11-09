<?php
// src/AppBundle/Controller/GameController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    /**
     * @Route("/game", name="game")
     */
    public function gameAction()
    {
        return $this->render(
            'game/index.html.twig'
            // array(
            //     'last_username' => 'hola mundo',
            //     'error'         => '',
            // )
        );

    }
}
