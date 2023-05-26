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
        $date1 = new \DateTime;
        $date1->setTime(0, 0, 0);
        $date2 = new \DateTime;
        $date2->modify('+1 day');
        $date2->setTime(0, 0, 0);

        
        $events = $eventRepository->EventTimeSlot( $date1 , $date2, $festival  );
       
        return $this->render('home/use.html.twig', [
            'festival' => $festival,
            'events' => $events,
            'notifications' => $notificationRepository->findByFestival($festival),
            'locations' => $locationRepository->findAll(),
        ]);
    }
   /*  #[Route('/{id}', name: 'app_home_festival', methods: ['GET'])]
    public function use($id, Festival $festival, NotificationRepository $notificationRepository, Request $request): Response
   {
        return $this->render('home/use.html.twig', [
            'festival' => $festival,
            'notifications' => $notificationRepository->findByFestival($festival),
        ]);
    }
 */

}
