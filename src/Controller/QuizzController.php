<?php

namespace App\Controller;

use App\Entity\Choix;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\TypeProfil;

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
        
        //Get the different scores for each category
        //Get the minimal score necessary to pass
        $successFactor = 0.5;
        $maxOfQuestion = 3;

        $pointsDiy = 0;
        $pointsDeplacements = 0;
        $pointsConso = 0;

        $totalDiy = 0;
        $totalDeplacements = 0;
        $totalConso = 0;

        foreach($choix as $num=>$choice){
            $categorie = $choice->getQuestion()->getCategorie();
            $value = $choice->getReponse()->getPoints();
            if ($categorie->getNom()=="diy"){
                $pointsDiy = $pointsDiy + $value;
                $totalDiy = $totalDiy + $maxOfQuestion;
            }
            if ($categorie->getNom()=="deplacements"){
                $pointsDeplacements = $pointsDeplacements + $value;
                $totalDeplacements = $totalDeplacements + $maxOfQuestion;
            }
            if ($categorie->getNom()=="consommation"){
                $pointsConso = $pointsConso + $value;
                $totalConso = $totalConso + $maxOfQuestion;
            }

        }
        
        $flagDeplacements = false;
        $flagDiy = false;
        $flagConso = false;

        //get the total of points for each category and set minima for success
        if($pointsDeplacements >= ($totalDeplacements * $successFactor)){
            $flagDeplacements = true;
        }
        if($pointsDiy >= ($totalDiy * $successFactor)){
            $flagDiy = true;
        }
        if($pointsConso >= ($totalConso * $successFactor)){
            $flagConso = true;
        }
        $arrayResults = [$flagConso, $flagDeplacements, $flagDiy];

        $repoProfiles = $em->getRepository(TypeProfil::class);
        $allProfiles = $repoProfiles->findAll();

        foreach($allProfiles as $index=>$profile){
            $consoProfile = $profile->getConsommation();
            $deplacementsProfile = $profile->getDeplacements();
            $diyProfile = $profile->getDiy();
            $arrayProfile = [$consoProfile, $deplacementsProfile, $diyProfile];
            if($arrayResults == $arrayProfile){
                //set profile type to user
                $currentUser = $this->getUser();
                $currentUser->setTypeProfil($profile);
                $em->persist($currentUser);
                $em->flush();

            }
        }
        $profilUtilisateur = $this->getUser()->getTypeProfil();
        return $this->render('quizz/analyse.html.twig', ['choices'=>$choix, 'profil'=>$profilUtilisateur]);

    }
}
