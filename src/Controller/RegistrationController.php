<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Status;
use App\Entity\Challenge;
use App\Entity\UserChallenge;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Security\FormulaireLoginAuthenticator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, FormulaireLoginAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            

            // do anything else you need here, like send an email
            // build the userchallenges
            $repChallenges = $entityManager->getRepository(Challenge::class);
            $allChallenges = $repChallenges->findAll();

            $repStatus = $entityManager->getRepository(Status::class);
            $todo = $repStatus->findOneBy(['nom'=>"todo"]);
            foreach ($allChallenges as $challenge){
                $potato = new UserChallenge();
                $potato->setUser($user);
                $potato->setStatus($todo);
                $potato->setChallenge($challenge);
                $entityManager->persist($potato);
            }

            

            $entityManager->flush();
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
