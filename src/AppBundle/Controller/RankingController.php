<?php
// src/AppBundle/Controller/RegistrationController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RankingController extends Controller {

    /**
     * @Route("/ranking", name="user_ranking")
     */
     public function rankingAction()
        {
          $em = $this->getDoctrine()->getManager();
          $usuarios = $em->getRepository('AppBundle:User')->findAll();

return $this->render('ranking/ranking.html.twig', array('usuarios' => $usuarios));
}
}
