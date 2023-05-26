<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Festival;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/festival/{festivalId}/event')]
class EventController extends AbstractController
{
    //get all events for a festival id
    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index($festivalId, EventRepository $eventRepository, FestivalRepository $festivalRepository): Response
    {

        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findBy(['festival' => $festivalId]),
            'festival' => $festivalRepository->find($festivalId),
        ]);
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new($festivalId, Request $request, EventRepository $eventRepository, FestivalRepository $festivalRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $festival = $festivalRepository->find($festivalId);
            $event->setFestival($festival);
            $eventRepository->save($event, true);

            return $this->redirectToRoute('app_event_index', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
            'festivalId' => $festivalId,
            'festival' => $festivalRepository->find($festivalId)
        ]);
    }

    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show($festivalId, Event $event, EventRepository $eventRepository, FestivalRepository $festivalRepository): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'festival' => $festivalRepository->find($festivalId)
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EventRepository $eventRepository, FestivalRepository $festivalRepository, $festivalId): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $festival = $festivalRepository->find($festivalId);
            $event->setFestival($festival);
            $eventRepository->save($event, true);

            return $this->redirectToRoute('app_event_index', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
            'festival' => $festivalRepository->find($festivalId)
        ]);
    }

}
