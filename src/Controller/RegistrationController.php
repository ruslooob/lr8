<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route("/register", name: 'app_register')]
    public function register(Request                     $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             UserAuthenticator           $userAuthenticator,
                             EntityManagerInterface      $entityManager
    ): Response
    {
        $user = new User();
        $userForm = $this->createForm(RegistrationFormType::class, $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $userForm->get('password')->getData())
            );
            $entityManager->persist($user);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser($user, $userAuthenticator, $request);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $userForm->createView(),
        ]);
    }
}