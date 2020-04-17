<?php

namespace App\Controller;

use App\Entity\Choix;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Form\QuizzChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $choix = new Choix();
        $form = $this->createForm(QuizzChoiceType::class, $choix);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            // $choix->setQuestion(
            //     $question
            // );
            // $choix->setReponse(
            //     $form->get('reponse');
            // );
        }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($choix);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return new Response('ok it works');

    }
}
