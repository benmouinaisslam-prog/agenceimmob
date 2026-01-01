<?php

namespace App\Controller;

use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    #[Route('/debug/biens', name: 'app_debug_biens', methods: ['GET'])]
    public function biens(BienRepository $bienRepository): JsonResponse
    {
        $total = count($bienRepository->findAll());
        $houses = count($bienRepository->findBy(['type' => 'house']));
        $apartments = count($bienRepository->findBy(['type' => 'apartment']));

        return $this->json([
            'total' => $total,
            'houses' => $houses,
            'apartments' => $apartments,
        ]);
    }
}
