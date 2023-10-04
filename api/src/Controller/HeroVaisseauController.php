<?php

namespace App\Controller;

use App\Entity\{
    HeroVaisseau,
    Joueur
};
use App\Repository\{
    JoueurRepository,
    HeroVaisseauRepository
};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Response
};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpClient\HttpClient;

#[Route('/api')]
class HeroVaisseauController extends AbstractController
{
    #[Route('/joueur/{ally_code}/heros', name: 'get_joueur_heros_by_ally_code', methods: ['GET'])]
    public function joueurHeros(HeroVaisseauRepository $herosRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager): JsonResponse
    {
        $heros = $herosRepository->findHerosByAllyCode(['player_code' => $ally_code]);

        return new JsonResponse(json_decode($serializer->serialize($heros, 'json'), true));
    }

    #[Route('/joueur/{ally_code}/vaisseaux', name: 'get_joueur_vaisseaux_by_ally_code', methods: ['GET'])]
    public function joueurVaisseaux(HeroVaisseauRepository $vaisseauxRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager): JsonResponse
    {
        $vaisseaux = $vaisseauxRepository->findVaisseauxByAllyCode(['player_code' => $ally_code]);

        return new JsonResponse(json_decode($serializer->serialize($vaisseaux, 'json'), true));
    }

    #[Route('/joueur/{ally_code}/hero/{hero_id}', name: 'get_joueur_hero_by_id', methods: ['GET'])]
    public function joueurHeroId(HeroVaisseauRepository $herosRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager, int $hero_id): JsonResponse
    {
        $hero = $herosRepository->findOneBy(['player_code' => $ally_code, 'id' => $hero_id, 'combat_type' => 1]);

        return new JsonResponse(json_decode($serializer->serialize($hero, 'json'), true));
    }

    #[Route('/joueur/{ally_code}/vaisseau/{vaisseau_id}', name: 'get_joueur_vaisseau_by_id', methods: ['GET'])]
    public function joueurVaisseauId(HeroVaisseauRepository $vaisseauxRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager, int $vaisseau_id): JsonResponse
    {
        $vaisseau = $vaisseauxRepository->findOneBy(['player_code' => $ally_code, 'id' => $vaisseau_id, 'combat_type' => 2]);

        return new JsonResponse(json_decode($serializer->serialize($vaisseau, 'json'), true));
    }
}
