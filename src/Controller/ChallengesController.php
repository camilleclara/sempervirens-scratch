<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChallengesController extends AbstractController
{
    /**
     * @Route("/challenges", name="challenges")
     */
    public function index()
    {
        return $this->render('challenges/index.html.twig', [
            'controller_name' => 'ChallengesController',
        ]);
    }
}
