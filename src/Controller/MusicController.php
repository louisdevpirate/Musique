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

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('music/home.html.twig');
    }

    #[Route('/music', name: 'app_music')]
    public function music(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Musique::class);

        $musiques = $repo->findAll();
        
        return $this->render('music/music.html.twig', [
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
