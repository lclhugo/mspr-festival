<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Form\FestivalType;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/festival')]
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
            $festivalRepository->save($festival, true);

            return $this->redirectToRoute('app_festival_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('festival/new.html.twig', [
            'festival' => $festival,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_festival_show', methods: ['GET'])]
    public function show(Festival $festival): Response
    {
        return $this->render('festival/show.html.twig', [
            'festival' => $festival,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_festival_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Festival $festival, FestivalRepository $festivalRepository): Response
    {
        $form = $this->createForm(FestivalType::class, $festival);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $festivalRepository->save($festival, true);

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
        if ($this->isCsrfTokenValid('delete'.$festival->getId(), $request->request->get('_token'))) {
            $festivalRepository->remove($festival, true);
        }

        return $this->redirectToRoute('app_festival_index', [], Response::HTTP_SEE_OTHER);
    }
}
