<?php

namespace App\Controller;

use App\Entity\Cotisations;
use App\Form\CotisationsType;
use App\Repository\CotisationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cotisations')]
final class CotisationsController extends AbstractController
{
    #[Route(name: 'app_cotisations_index', methods: ['GET'])]
    public function index(CotisationsRepository $cotisationsRepository): Response
    {
        return $this->render('cotisations/index.html.twig', [
            'cotisations' => $cotisationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cotisations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cotisation = new Cotisations();
        $form = $this->createForm(CotisationsType::class, $cotisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cotisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_cotisations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cotisations/new.html.twig', [
            'cotisation' => $cotisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cotisations_show', methods: ['GET'])]
    public function show(Cotisations $cotisation): Response
    {
        return $this->render('cotisations/show.html.twig', [
            'cotisation' => $cotisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cotisations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cotisations $cotisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CotisationsType::class, $cotisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cotisations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cotisations/edit.html.twig', [
            'cotisation' => $cotisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cotisations_delete', methods: ['POST'])]
    public function delete(Request $request, Cotisations $cotisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cotisation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cotisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cotisations_index', [], Response::HTTP_SEE_OTHER);
    }
}
