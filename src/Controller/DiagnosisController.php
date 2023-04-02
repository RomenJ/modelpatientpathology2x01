<?php

namespace App\Controller;

use App\Entity\Diagnosis;
use App\Form\DiagnosisType;
use App\Repository\DiagnosisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/diagnosis')]
class DiagnosisController extends AbstractController
{
    #[Route('/', name: 'app_diagnosis_index', methods: ['GET'])]
    public function index(DiagnosisRepository $diagnosisRepository): Response
    {
        return $this->render('diagnosis/index.html.twig', [
            'diagnoses' => $diagnosisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_diagnosis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DiagnosisRepository $diagnosisRepository): Response
    {
        $diagnosi = new Diagnosis();
        $form = $this->createForm(DiagnosisType::class, $diagnosi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diagnosisRepository->save($diagnosi, true);

            return $this->redirectToRoute('app_diagnosis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diagnosis/new.html.twig', [
            'diagnosi' => $diagnosi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_diagnosis_show', methods: ['GET'])]
    public function show(Diagnosis $diagnosi): Response
    {
        return $this->render('diagnosis/show.html.twig', [
            'diagnosi' => $diagnosi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_diagnosis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Diagnosis $diagnosi, DiagnosisRepository $diagnosisRepository): Response
    {
        $form = $this->createForm(DiagnosisType::class, $diagnosi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diagnosisRepository->save($diagnosi, true);

            return $this->redirectToRoute('app_diagnosis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diagnosis/edit.html.twig', [
            'diagnosi' => $diagnosi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_diagnosis_delete', methods: ['POST'])]
    public function delete(Request $request, Diagnosis $diagnosi, DiagnosisRepository $diagnosisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diagnosi->getId(), $request->request->get('_token'))) {
            $diagnosisRepository->remove($diagnosi, true);
        }

        return $this->redirectToRoute('app_diagnosis_index', [], Response::HTTP_SEE_OTHER);
    }
}
