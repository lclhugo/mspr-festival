<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FestivalRepository;
use App\Entity\Festival;
use App\Repository\NotificationRepository;
use App\Entity\Notification;
use App\Repository\EventRepository;

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

    #[Route('/map', name: 'map')]
    public function map(LocationRepository $locationRepository): Response
    {
        return $this->render('home/map.html.twig', [
            'controller_name' => 'HomeController',
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/festival/{id}', name: 'app_festival', methods: ['GET'])]
    public function show(Festival $festival, EventRepository $eventRepository, NotificationRepository $notificationRepository, FestivalRepository $festivalRepository, LocationRepository $locationRepository): Response
    {
        return $this->render('home/use.html.twig', [
            'festival' => $festival,
            'events' => $eventRepository->findBy(['festival' => $festival]),
            'notifications' => $notificationRepository->findAll(),
            'locations' => $locationRepository->findAll(),
        ]);
    }



}
