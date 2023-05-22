<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FestivalRepository;
use App\Entity\Festival;
use App\Entity\Notification;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FestivalRepository $festivalRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'festivals' => $festivalRepository->findAll(),
        ]);
    }
//    #[Route('/{id}', name: 'app_home_festival', methods: ['GET'])]
//    public function use(Festival $festival, FestivalRepository $festivalRepository, Request $request): Response
//    {
//        return $this->render('home/use.html.twig', [
//            'festival' => $festival,
//        ]);
//    }
}
