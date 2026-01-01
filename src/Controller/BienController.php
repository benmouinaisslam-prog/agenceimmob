<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bien')]
final class BienController extends AbstractController
{
    #[Route(name: 'app_bien_index', methods: ['GET'])]
    public function index(Request $request, BienRepository $bienRepository): Response
    {
        $type = $request->query->get('type');
        $q = $request->query->get('q');

        $biens = $bienRepository->search($type, $q);

        return $this->render('bien/index.html.twig', [
            'biens' => $biens,
            'selected_type' => $type,
        ]);
    }

    #[Route('/new', name: 'app_bien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_bien_show', requirements: ['id' => '\\d+'], methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        return $this->render('bien/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/houses', name: 'app_bien_houses', methods: ['GET'])]
    public function houses(BienRepository $bienRepository): Response
    {
        $biens = $bienRepository->findBy(['type' => 'house']);

        return $this->render('bien/index.html.twig', [
            'biens' => $biens,
            'selected_type' => 'house',
        ]);
    }

    #[Route('/apartments', name: 'app_bien_apartments', methods: ['GET'])]
    public function apartments(BienRepository $bienRepository): Response
    {
        $biens = $bienRepository->findBy(['type' => 'apartment']);

        return $this->render('bien/index.html.twig', [
            'biens' => $biens,
            'selected_type' => 'apartment',
        ]);
    }

    // --- Alias routes (singular/plural and French) ---
    #[Route('/house', name: 'app_bien_house', methods: ['GET'])]
    #[Route('/maison', name: 'app_bien_maison', methods: ['GET'])]
    public function houseAlias(): Response
    {
        return $this->redirectToRoute('app_bien_houses');
    }

    #[Route('/houses', name: 'app_bien_houses_alias', methods: ['GET'])]
    public function housesAlias(): Response
    {
        return $this->redirectToRoute('app_bien_houses');
    }

    #[Route('/appartement', name: 'app_bien_appartement', methods: ['GET'])]
    #[Route('/appartements', name: 'app_bien_appartements', methods: ['GET'])]
    public function appartementAlias(): Response
    {
        return $this->redirectToRoute('app_bien_apartments');
    }

    #[Route('/{id}/edit', name: 'app_bien_edit', requirements: ['id' => '\\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Bien $bien, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_bien_delete', requirements: ['id' => '\\d+'], methods: ['POST'])]
    public function delete(Request $request, Bien $bien, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isCsrfTokenValid('delete'.$bien->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
    }
}
