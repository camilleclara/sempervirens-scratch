<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Form\MessageRegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     */
    public function messagerie()
    {
        // $em = $this->getDoctrine()->getManager();
        // $rep = $em->getRepository(Message::class);
        // $messages= $rep->findBy(['toUser', $this->getUser()]);
        // $sendmessages = $rep->findBy(['fromUser', $this->getUser()]);
        $em = $this->getDoctrine()->getManager();
        $messages = $this->getUser()->getMessages();
        $sendmessages = $this->getUser()->getSendMessages();
        $newmessages = [];
        foreach ($sendmessages as $content){
            if(!$content->getVu()){
                $newmessages[] = $content;
            }
        }
        
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController', 'messages'=>$messages, 'sendmessages'=>$sendmessages, 'newmessages'=>$newmessages
        ]);
        
    }
    /**
     * @Route("/messages/notifications", name="notifications")
     */
    public function notifications(){
        //Recupérer tout les messages reçus de l'utilisateur
        //Récupérer ceux qui ont le statut non lus
        //compter
        //Retourner le chiffre
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Message::class);
        $current = $this->getUser();
        $messages = $rep->findBy(['toUser'=>$current, 'vu'=>false]);

        $number = 0;
        if ($messages){
            $number = count($messages);
        }
        return new Response ("<span class='badge badge-danger badge-counter' style='position: absolute;
        transform: scale(.5);
        transform-origin: top right;
        '>".$number."</span>");
    }
    /**
     * @Route("/read/message/", name="message_read")
     */
    public function read(Request $req){
        //Recuperer l'objet message apd de son id passé en post
        //changer la valeur du vu de 0 à 1 dans la db pour ce message
        //flush
        //retourner à la messagerie

        
        
            $idmessage = $req->get("message");
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository(Message::class);
            $message = $rep->findOneBy(['id'=>$idmessage]);
            $message->setVu(true);
            $em->persist($message);
            $em->flush();

        return $this->RedirectToRoute('messages');

        
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
        if ($member == $this->getUser()){
            return $this->RedirectToRoute("profile");
        }
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
