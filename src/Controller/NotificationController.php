<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Form\NotificationType;
use App\Repository\FestivalRepository;
use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/festival/{festivalId}/notifications')]
class NotificationController extends AbstractController
{
    #[Route('/', name: 'app_notification_index', methods: ['GET'])]
    public function index($festivalId, NotificationRepository $notificationRepository, FestivalRepository $festivalRepository): Response
    {
        return $this->render('notification/index.html.twig', [
            'notifications' => $notificationRepository->findBy(['festival' => $festivalId]),
            'festival' => $festivalRepository->find($festivalId),
            'festivalId' => $festivalId,
        ]);
    }

    #[Route('/new', name: 'app_notification_new', methods: ['GET', 'POST'])]
    public function new($festivalId, Request $request, NotificationRepository $notificationRepository, FestivalRepository $festivalRepository): Response
    {
        $notification = new Notification();
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $festival = $festivalRepository->find($festivalId);
            $notification->setFestival($festival);
            $notificationRepository->save($notification, true);

            return $this->redirectToRoute('app_notification_index', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('notification/new.html.twig', [
            'notification' => $notification,
            'form' => $form,
            'festivalId' => $festivalId,
            'festival' => $festivalRepository->find($festivalId)
        ]);
    }

    #[Route('/{id}', name: 'app_notification_show', methods: ['GET'])]
    public function show(Notification $notification): Response
    {
        return $this->render('notification/show.html.twig', [
            'notification' => $notification,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_notification_edit', methods: ['GET', 'POST'])]
    public function edit(int $festivalId, Request $request, Notification $notification, NotificationRepository $notificationRepository, FestivalRepository $festivalRepository): Response
    {
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $festival = $festivalRepository->find($festivalId);
            $notification->setFestival($festival);
            $notificationRepository->save($notification, true);

            return $this->redirectToRoute('app_notification_index', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('notification/edit.html.twig', [
            'notification' => $notification,
            'form' => $form,
            'festivalId' => $festivalId,
            'festival' => $festivalRepository->find($festivalId)
        ]);
    }

    #[Route('/{id}', name: 'app_notification_delete', methods: ['POST'])]
    public function delete(int $festivalId, Request $request, Notification $notification, NotificationRepository $notificationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notification->getId(), $request->request->get('_token'))) {
            $notificationRepository->remove($notification, true);
        }

        return $this->redirectToRoute('app_notification_index', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
    }

}
