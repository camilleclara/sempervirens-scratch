<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EcoboutiqueController extends AbstractController
{
    /**
     * @Route("/ecoboutique", name="ecoboutique")
     */
    public function index()
    {
        return $this->render('ecoboutique/index.html.twig', [
            'controller_name' => 'EcoboutiqueController',
        ]);
    }
}
