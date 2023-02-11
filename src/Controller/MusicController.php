<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Musique;
use App\Form\MusiqueType;



class MusicController extends AbstractController
{

    #[Route('/music', name: 'app_music')]
    public function index(): Response
    {
        return $this->render('music/index.html.twig', [
            'controller_name' => 'MusicController',
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function home(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Musique::class);

        $musiques = $repo->findAll();
        
        return $this->render('music/home.html.twig', [
            'title' => 'Bienvenue à toi !',
            'musiques' => $musiques,
        ]);
    }

    #[Route('/add', name: 'app_add')]
    public function add(Request $request, EntityManagerInterface $manager)
    {
        $musique = new Musique(); 

        $form = $this->createForm(MusiqueType::class, $musique);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($musique);

            $manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('music/add.html.twig', [
            'formMusique' => $form->createView()
        ]);
    }
}
