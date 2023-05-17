<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/map', name: 'map')]
    public function map(LocationRepository $locationRepository): Response
    {
        return $this->render('home/map.html.twig', [
            'controller_name' => 'HomeController',
            'locations' => $locationRepository->findAll(),
        ]);
    }
}
