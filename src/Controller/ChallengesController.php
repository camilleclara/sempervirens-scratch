<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Challenge;
use App\Entity\UserChallenge;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChallengesController extends AbstractController
{
    /**
     * @Route("/challenges", name="challenges")
     */
    public function index(Request $req, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Challenge::class);

        $repStatus=$em->getRepository(Status::class);
        $repStatusOne=$em->getRepository(Status::class);
        
        $accepted=$repStatusOne->findOneBy(['nom'=>'accepted']);
        
        $repUserChallenge =$em->getRepository(UserChallenge::class);
        $allUserChallenges = $repUserChallenge->findAll();

        

        //S'il a reçu quelque chose, updater le statut du challenge et retourner au profil
        if(count($req->request)>0){
            //Apporter l'objet status
            $statusString = $req->get("status");
            $statusO = $repStatus->findOneBy(['nom'=>$statusString]);

            //Apporter l'objet challenge
            $challengeString = $req->get('challenge');
            $challengeO = $rep->findOneBy(['id'=>$challengeString]);

            //Updater le userChallengeCorrespondant
            foreach($allUserChallenges as $userChal){
                if(($userChal->getChallenge())==$challengeO){
                    $userChal->setStatus($statusO);
                    $em->persist($userChal);
                }
            }
            $em->flush();
            
        }
        //Trouver le challenge accepted
        $challengeAccepted = null;

        foreach($allUserChallenges as $chal){
            if($chal->getStatus()==$accepted){
                $challengeAccepted = $chal;
            }
        }
        //Si aucun challenge accepté, trouver le challenge proposé
        //Trouver les challenges qui n'ont pas encore été réalisés
        //En prendre un au hasard
        $alluser = $this->getUser()->getUserChallenges();
        $todoChallenges = [];
        foreach($alluser as $ch){
            if ($ch->getStatus()->getNom()=="todo"){
                $todoChallenges[]= $ch;
            }
        }
        $random = rand(0, count($todoChallenges)-1);
        $nextChallenge = $todoChallenges[$random];
        

        $challenges = $rep->findAll();
        $numeroPage = $req->query->getInt('page',1);
        $paginationChallenges = $paginator->paginate($challenges, $numeroPage);
        return $this->render('challenges/index.html.twig', [
            'controller_name' => 'ChallengesController','paginationChallenges'=>$paginationChallenges, 'acceptedChallenge'=>$challengeAccepted, 'nextChallenge'=>$nextChallenge
        ]);
    }
}
