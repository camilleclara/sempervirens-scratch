<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz/{int}", name="quizz")
     */
    public function index(Request $req)
    {
        $num=$req->get("int");
        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);
        $question = $repQ->findOneBy(["id"=>$num]);

        $repR = $em->getRepository(Reponse::class);
        $reponses = $repR->findBy(['question'=>$num]);

        return $this->render('quizz/index.html.twig', [
            'controller_name' => 'QuizzController', 'question'=> $question, 'reponses'=>$reponses
        ]);
    }
    /**
     * @Route("/quizz/{int}", name="test_quizz")
     */
    public function testquizz(Request $req)
    {
        $num=$req->get("int");
        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);
        $question = $repQ->findOneBy(["id"=>$num]);

        $repR = $em->getRepository(Reponse::class);
        $reponses = $repR->findBy(['question'=>$num]);

        return $this->render('quizz/index.html.twig', [
            'controller_name' => 'QuizzController', 'question'=> $question, 'reponses'=>$reponses
        ]);

    }
}
