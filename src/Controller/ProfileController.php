<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Status;
use App\Entity\Message;
use App\Entity\Challenge;
use App\Entity\UserChallenge;
use App\Form\MessageRegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Challenge::class);

        $repStatus=$em->getRepository(Status::class);
        $repStatusOne=$em->getRepository(Status::class);
        $repStatusTwo=$em->getRepository(Status::class);
        

        $accepted=$repStatusOne->findOneBy(['nom'=>'accepted']);
        $done=$repStatusTwo->findBy(['nom'=>'done']);
        
        $repUserChallenge =$em->getRepository(UserChallenge::class);
        $repUserChallengeTwo =$em->getRepository(UserChallenge::class);

        $allUserChallenges = $repUserChallenge->findBy(['user'=>$this->getUser()]);
        $doneChallenges = $repUserChallengeTwo->findBy(['status'=>$done,'user'=>$this->getUser()]);

        $challengeAccepted = null;

        //TODO: faire une fonction getAcceptedChallenge 
        //TODO: comparer les indexes de $chal et $accepted plutôt que les objets eux-mêmes

        foreach($allUserChallenges as $chal){
            if($chal->getStatus()==$accepted){
                $challengeAccepted = $chal;
            }
        }
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController', 'acceptedChallenge'=>$challengeAccepted, 'doneChallenges'=>$doneChallenges
        ]);
    }
}
