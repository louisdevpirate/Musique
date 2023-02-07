<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function home(): Response
    {
        return $this->render('music/home.html.twig', [
            'title' => 'Bienvenue à toi !',
            'age' => 31,
        ]);
    }
}
