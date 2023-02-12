<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;
use App\Form\ArtistType;



class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function show(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Artist::class);

        $artists = $repo->findAll();
        
        return $this->render('artist/artist.html.twig', [
            'artists' => $artists,
        ]);
    }
    

    #[Route('/create_artist', name: 'app_create_artist')]
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $artist = new Artist(); 

        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($artist);

            $manager->flush();

            return $this->redirectToRoute('app_artist');
        }

        return $this->render('artist/new_artist.html.twig', [
            'formArtist' => $form->createView()
        ]);
    }
}
