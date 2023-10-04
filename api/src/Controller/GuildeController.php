<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Response
};
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\{
    JoueurRepository,
    GuildeRepository
};

#[Route('/api')]
class GuildeController extends AbstractController
{
    #[Route('/{ally_code}/guilde', name: 'joueur_guilde', methods: ['GET'])]
    public function joueurGuilde(JoueurRepository $joueurRepository, GuildeRepository $guildeRepository, SerializerInterface $serializer, int $ally_code): JsonResponse
    {
        $joueur = $joueurRepository->findOneBy(['ally_code' => $ally_code]);

        if ($joueur) {
            $guilde = $guildeRepository->findOneBy(['guilde_id' => $joueur->getGuilde()]);
        }

        return new JsonResponse(json_decode($serializer->serialize($guilde, 'json'), true));
    }
}
