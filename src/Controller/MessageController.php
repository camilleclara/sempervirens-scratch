<?php

namespace App\Controller;

use App\Entity\Message;
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
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController', 'messages'=>$messages, 'sendmessages'=>$sendmessages
        ]);
        
    }
}
