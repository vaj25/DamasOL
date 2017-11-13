<?php
// src/AppBundle/Controller/GameController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Partida;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */

    public function indexAction() {
        return $this->render(
            'game/index.html.twig'
        );
    }

    /**
     * @Route("/game/{idPartida}", name="game")
     */
    public function gameAction() {
        return $this->render(
            'game/game.html.twig'
            // array(
            //     'last_username' => 'hola mundo',
            //     'error'         => '',
            // )
        );
    }

    /**
     * @Route("/partida/new", name="create_partida")
     */
    public function nuevaAction() {
        date_default_timezone_set('America/El_Salvador');

        $partida = new Partida();
        $partida
            ->setJugador1($this->getUser()->getId())
            ->setFecha( new \DateTime() )
            ->setIsActive(true);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($partida);
        $em->flush();

        return $this->redirect('/game/'.$partida->getId());

    }

}
