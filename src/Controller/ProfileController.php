<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
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
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
    /**
     * @Route("/someone/", name="other_profile")
     */
    public function show(Request $req)
    {
        $pseudo = $req->request->get("pseudo");
        $em = $this->getDoctrine()->getManager();
        $rep= $em->getRepository(User::class);
        $member = $rep->findOneBy(['pseudo'=> $pseudo]);
        $message = new Message();
        $formulaireMessage=$this->createForm(MessageRegistrationFormType::class, $message);
        $formulaireMessage->handleRequest($req);
        if($formulaireMessage->isSubmitted()&&$formulaireMessage->isValid()){
            
            $message->setFromUser($this->getUser());
            $message->setVu(false);
            $member = $rep->findOneBy(['pseudo'=> $pseudo]);
            $message->setToUser($member);
            $em=$this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            return $this->RedirectToRoute('messages');
        }
        else {
            return $this->render('profile/other_profile.html.twig', [
                'controller_name' => 'ProfileController', 'member'=>$member, 'formulaire'=>$formulaireMessage->createView()
            ]);
        }
        
    }

}
