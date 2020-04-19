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

            if($nextQuestion >= $questionsCount){
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
        return $this->render('quizz/analyse.html.twig');

    }

    /**
     * @Route("/quizz/fritata/{int}", name="quizz")
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
     * @Route("/quizz/potato/{page?1}", name="test_quizz")
     */
    public function testquizz(Request $req)
    {
        //Get the right id from the request route
        $page=$req->get("page");
        if (!isset($page)){
            $page = 1;
        }
        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);

        //get the question with its id
        $question = $repQ->findOneBy(["id"=>$page]);

        //get possible answers with question id
        $repR = $em->getRepository(Reponse::class);
        $reponses = $repR->findBy(['question'=>$page]);

        //handling the form
    
        //start by creating a form
        $choix = new Choix();
        $form = $this->createForm(QuizzChoiceType::class, $choix);
        $form->handleRequest($req);

        //what to do if the form is submitted
        if ($form->isSubmitted() && $form->isValid()) {
            $choix->setQuestion(
                $question
            );
            $choix->setReponse(
                $form->get('reponse')
            );
        }
        //load infos in db
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($choix);
        $entityManager->flush();

            // do anything else you need here, like send an email

        return $this->render('quizz/index.html.twig', [
            'question'=>$question, 'reponses'=>$reponses
        ]);

    }
    
    /**
     * @Route("/quizz/handle", name="handle_form")
     */
    public function handleForm(Request $req)
    {
        //Get the right id from the request route
        $idquestion=$req->request->get("question");
        $idreponse=$req->request->get("reponse");

        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);
        $question = $repQ->findOneBy(["id"=>$idquestion]);

        $repR = $em->getRepository(Reponse::class);
        $reponse = $repR->findOneBy(['id'=>$idreponse]);

        $choix = new Choix();
        $choix->setUser($this->getUser());

        $choix->setReponse($reponse);
        $choix->setQuestion($question);

        $em->persist($choix);
        $em->flush();

            // do anything else you need here, like send an email

        return $this->render('quizz/working.html.twig', [
             'choix'=>$choix
            ]);

    }

    
}
