<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrajetsController extends AbstractController
{
    /**
     * @Route("/trajets", name="trajets")
     */
    public function index()
    {
        return $this->render('trajets/index.html.twig', [
            'controller_name' => 'TrajetsController',
        ]);
    }
}
