<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder){

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $plainPassword = $user->getPassword();
            $encodedPassword = $encoder->hashPassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('security/registration.html.twig', [
            'formSecurity' => $form->createView()
        ]);
    }
}