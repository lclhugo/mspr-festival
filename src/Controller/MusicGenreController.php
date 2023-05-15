<?php

namespace App\Controller;

use App\Entity\MusicGenre;
use App\Form\MusicGenreType;
use App\Repository\MusicGenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/music/genre')]
class MusicGenreController extends AbstractController
{
    #[Route('/', name: 'app_music_genre_index', methods: ['GET'])]
    public function index(MusicGenreRepository $musicGenreRepository): Response
    {
        return $this->render('music_genre/index.html.twig', [
            'music_genres' => $musicGenreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_music_genre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MusicGenreRepository $musicGenreRepository): Response
    {
        $musicGenre = new MusicGenre();
        $form = $this->createForm(MusicGenreType::class, $musicGenre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $musicGenreRepository->save($musicGenre, true);

            return $this->redirectToRoute('app_music_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('music_genre/new.html.twig', [
            'music_genre' => $musicGenre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_music_genre_show', methods: ['GET'])]
    public function show(MusicGenre $musicGenre): Response
    {
        return $this->render('music_genre/show.html.twig', [
            'music_genre' => $musicGenre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_music_genre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MusicGenre $musicGenre, MusicGenreRepository $musicGenreRepository): Response
    {
        $form = $this->createForm(MusicGenreType::class, $musicGenre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $musicGenreRepository->save($musicGenre, true);

            return $this->redirectToRoute('app_music_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('music_genre/edit.html.twig', [
            'music_genre' => $musicGenre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_music_genre_delete', methods: ['POST'])]
    public function delete(Request $request, MusicGenre $musicGenre, MusicGenreRepository $musicGenreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$musicGenre->getId(), $request->request->get('_token'))) {
            $musicGenreRepository->remove($musicGenre, true);
        }

        return $this->redirectToRoute('app_music_genre_index', [], Response::HTTP_SEE_OTHER);
    }
}
