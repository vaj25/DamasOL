<?php
// src/AppBundle/Controller/GameController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Partida;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GameController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */

    public function indexAction() {

        $repositorio =  $this->getDoctrine()->getRepository('AppBundle:Partida');
        
        $query = $repositorio->createQueryBuilder('p')
            ->where('p.jugador2 is NULL')
            ->getQuery();

        $query1 = $repositorio->createQueryBuilder('p')
            ->where('p.isActive = 1')
            ->where('p.jugador2 is not NULL')
            ->getQuery();

        return $this->render(
            'game/index.html.twig',
            array(
                'partidas' => $query->getResult(),
                'verPartidas' => $query1->getResult()
            )
        );
    }

    /**
     * @Route("/game/{idPartida}", name="game")
     */
    public function gameAction($idPartida) {
        return $this->render(
            'game/game.html.twig',
            array(
                'partida' => $idPartida
            )
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

    /**
     * @Route("partida/updatej/{idPartida}", name="actualizar_partida_jugador")
     */
    public function updateJAction($idPartida) {
        $em = $this->getDoctrine()->getManager();
        $partida = $em->getRepository('AppBundle:Partida')->find($idPartida);

        if ($partida) {
            $partida->setJugador2($this->getUser()->getId());
            $em->flush();
            return $this->redirect('/game/'.$idPartida);
        } else {
            return $this->redirect('/');
        }
    
    }

    /**
     * @Route("/partida/jugador", name="partida_jugador")
     * @Method({"POST"})
     */
    public function partidaJugadorAction(Request $request) {
        
        if($request->isXmlHttpRequest()) {
            $id = $request->get("partida");
            $partida =  $this->getDoctrine()->getRepository('AppBundle:Partida')->find($id);
            $return = array('response' => 'null');

            if ($partida) {
                if ($partida->getJugador1() == $this->getUser()->getId()) {
                    $return['response'] = "white";
                } elseif ($partida->getJugador2() == $this->getUser()->getId()) {
                    $return['response'] = "black";
                } else {
                    $return['response'] = "visited";
                }
            }
            
            return new JsonResponse($return);
        }
    }

}
