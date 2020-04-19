<?php

namespace App\Controller;

use App\Entity\Scroll;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    public function truthScroll()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Scroll::class);
        //get Total Number of scrolls
        $repTotalScrolls = $em->getRepository(Scroll::class);
        $allScrolls = $repTotalScrolls->findAll();
        $scrollsCount = count($allScrolls);
        $random = random_int(0, $scrollsCount);

        $scroll = $rep->findOneBy(["id"=>$random]);
        $text= $scroll->getTexte();
        return new Response($text);
    }
}
