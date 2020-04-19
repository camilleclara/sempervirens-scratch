<?php

namespace App\Controller;

use App\Entity\Choix;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Form\QuizzChoiceType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz/", name="create_form")
     */
    public function createFormulaire(Request $req, SessionInterface $session)
    {
        

        //If there was something in poste, execute this:
        if($req->request->count()>0){

            $idreponse=$req->request->get("reponse");
            $em = $this->getDoctrine()->getManager();
            $repQ = $em->getRepository(Question::class);
            $repR = $em->getRepository(Reponse::class);
            $reponse = $repR->findOneBy(['id'=>$idreponse]);
            $question = $reponse->getQuestion();
            $choix = new Choix();
            $choix->setUser($this->getUser());

            $choix->setReponse($reponse);
            $choix->setQuestion($question);

            $em->persist($choix);
            $em->flush();

            //check if it was the last question
            $repTotalQuestions = $em->getRepository(Question::class);
            $allQuestions = $repTotalQuestions->findAll();
            $questionsCount = count($allQuestions);
            $nextQuestion = $session->get('pagenum');

            if($nextQuestion > $questionsCount){
                return $this->RedirectToRoute("analyse_result");
            }
            return $this->RedirectToRoute("create_form");
        }
        //Get or initialize page numberin session to know what question to display
        $page = $session->get("pagenum");
        if (!$page){
            $page = 1;
        }
        
        //Get the right id from the request route
        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);

        //get the question with its id
        $question = $repQ->findOneBy(["id"=>$page]);

        //get possible answers with question id
        $repR = $em->getRepository(Reponse::class);
        $reponses = $repR->findBy(['question'=>$page]);

        //increment pagenumber in the session
        $incrempage = $page +1;
        $session->set("pagenum", $incrempage);

        return $this->render('quizz/index.html.twig', [
            'question'=>$question, 'reponses'=>$reponses
        ]);

    }
    /**
     * @Route("/analyse/quizz/", name="analyse_result")
     */
    public function analyse(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Choix::class);
        $choix = $this->getUser()->getChoixes();
        
        return $this->render('quizz/analyse.html.twig', ['choices'=>$choix]);

    }
}
