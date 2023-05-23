<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Form\FestivalType;
use App\Repository\FestivalRepository;
use App\Repository\LocationRepository;
use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/festival')]
class FestivalController extends AbstractController
{
    #[Route('/', name: 'app_festival_index', methods: ['GET'])]
    public function index(FestivalRepository $festivalRepository): Response
    {
        return $this->render('festival/index.html.twig', [
            'festivals' => $festivalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_festival_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FestivalRepository $festivalRepository): Response
    {
        $festival = new Festival();
        $form = $this->createForm(FestivalType::class, $festival);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($festival->getStartDate() > $festival->getEndDate()) {
                $this->addFlash('festivalError', 'La date de début doit être antérieure à la date de fin');
                return $this->redirectToRoute('app_festival_new');
            }
            $festivalRepository->save($festival, true);
            $this->addFlash('festivalSuccess', 'Le festival a bien été ajouté');

            return $this->redirectToRoute('app_festival_index', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('festival/new.html.twig', [
            'festival' => $festival,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_festival_show', methods: ['GET'])]
    public function show(Festival $festival, NotificationRepository $notificationRepository, FestivalRepository $festivalRepository, LocationRepository $locationRepository): Response
    {
        return $this->render('festival/show.html.twig', [
            'festival' => $festival,
            'notifications' => $notificationRepository->findAll(),
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_festival_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Festival $festival, FestivalRepository $festivalRepository): Response
    {
        $form = $this->createForm(FestivalType::class, $festival);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //compare the two datetime object startDate and endDate
            if ($festival->getStartDate() > $festival->getEndDate()) {
                $this->addFlash('festivalError', 'La date de début doit être antérieure à la date de fin');
                return $this->redirectToRoute('app_festival_edit', ['id' => $festival->getId()]);
            }
            $festivalRepository->save($festival, true);
            $this->addFlash('festivalSuccess', 'Le festival a bien été modifié');

            return $this->redirectToRoute('app_festival_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('festival/edit.html.twig', [
            'festival' => $festival,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_festival_delete', methods: ['POST'])]
    public function delete(Request $request, Festival $festival, FestivalRepository $festivalRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $festival->getId(), $request->request->get('_token'))) {
            $festivalRepository->remove($festival, true);
        }

        return $this->redirectToRoute('app_festival_index', [], Response::HTTP_SEE_OTHER);
    }
}
