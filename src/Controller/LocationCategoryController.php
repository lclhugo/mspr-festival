<?php

namespace App\Controller;

use App\Entity\LocationCategory;
use App\Form\LocationCategoryType;
use App\Repository\LocationCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/location/category')]
class LocationCategoryController extends AbstractController
{
    #[Route('/', name: 'app_location_category_index', methods: ['GET'])]
    public function index(LocationCategoryRepository $locationCategoryRepository): Response
    {
        return $this->render('location_category/index.html.twig', [
            'location_categories' => $locationCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_location_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LocationCategoryRepository $locationCategoryRepository): Response
    {
        $locationCategory = new LocationCategory();
        $form = $this->createForm(LocationCategoryType::class, $locationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locationCategoryRepository->save($locationCategory, true);

            return $this->redirectToRoute('app_location_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location_category/new.html.twig', [
            'location_category' => $locationCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_location_category_show', methods: ['GET'])]
    public function show(LocationCategory $locationCategory): Response
    {
        return $this->render('location_category/show.html.twig', [
            'location_category' => $locationCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_location_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LocationCategory $locationCategory, LocationCategoryRepository $locationCategoryRepository): Response
    {
        $form = $this->createForm(LocationCategoryType::class, $locationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locationCategoryRepository->save($locationCategory, true);

            return $this->redirectToRoute('app_location_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location_category/edit.html.twig', [
            'location_category' => $locationCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_location_category_delete', methods: ['POST'])]
    public function delete(Request $request, LocationCategory $locationCategory, LocationCategoryRepository $locationCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locationCategory->getId(), $request->request->get('_token'))) {
            $locationCategoryRepository->remove($locationCategory, true);
        }

        return $this->redirectToRoute('app_location_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
