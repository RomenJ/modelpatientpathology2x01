<?php

namespace App\Controller;

use App\Entity\Pathology;
use App\Form\PathologyType;
use App\Repository\PathologyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pathology')]
class PathologyController extends AbstractController
{
    #[Route('/', name: 'app_pathology_index', methods: ['GET'])]
    public function index(PathologyRepository $pathologyRepository): Response
    {
        return $this->render('pathology/index.html.twig', [
            'pathologies' => $pathologyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pathology_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PathologyRepository $pathologyRepository): Response
    {
        $pathology = new Pathology();
        $form = $this->createForm(PathologyType::class, $pathology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pathologyRepository->save($pathology, true);

            return $this->redirectToRoute('app_pathology_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pathology/new.html.twig', [
            'pathology' => $pathology,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pathology_show', methods: ['GET'])]
    public function show(Pathology $pathology): Response
    {
        return $this->render('pathology/show.html.twig', [
            'pathology' => $pathology,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pathology_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pathology $pathology, PathologyRepository $pathologyRepository): Response
    {
        $form = $this->createForm(PathologyType::class, $pathology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pathologyRepository->save($pathology, true);

            return $this->redirectToRoute('app_pathology_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pathology/edit.html.twig', [
            'pathology' => $pathology,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pathology_delete', methods: ['POST'])]
    public function delete(Request $request, Pathology $pathology, PathologyRepository $pathologyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pathology->getId(), $request->request->get('_token'))) {
            $pathologyRepository->remove($pathology, true);
        }

        return $this->redirectToRoute('app_pathology_index', [], Response::HTTP_SEE_OTHER);
    }
}
