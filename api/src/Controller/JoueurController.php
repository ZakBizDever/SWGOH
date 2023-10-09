<?php

namespace App\Controller;

use App\Entity\{
    Joueur,
    HeroVaisseau,
    Guilde,
    JoueurGuilde
};
use App\Repository\{
    JoueurRepository,
    HeroVaisseauRepository
};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Response,
    Request
};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClient;

#[Route('/api')]
class JoueurController extends AbstractController
{
    private $apiUrls = [
        'joueur' => 'https://swgoh.gg/api/player/{ally_code}/',
        'guilde' => 'https://swgoh.gg/api/guild-profile/{guilde_id}'
    ];

    private $baseUrlSwgoh = 'https://swgoh.gg';


    #[Route('/joueurss', name: 'get_all_joueurs', methods: ['GET'])]
    public function joueurs(JoueurRepository $joueurRepository, SerializerInterface $serializer): JsonResponse
    {
        $joueurs = $joueurRepository->findAll();

        // $data = [];
        // foreach ($joueurs as $joueur) {
        //     $data[] = [
        //         'id' => $joueur->getAllyCode(),
        //         'pseudo' => $joueur->getPseudo(),
        //         'tire' => $joueur->getTitre(),
        //         'level' => $joueur->getNiveau(),
        //         'pg_totale' => $joueur->getPgTotale(),
        //         'pg_heros' => $joueur->getPgHeros(),
        //         'pg_vaisseau' =>  $joueur->getPgVaisseaux(),
        //         'profile' => $joueur->getLienProfil()
        //     ];
        // }

        // $dataJ = $serializer->serialize($joueurs, 'json');
        // $foo = $serializer->serialize($joueurs, 'json');

        return new JsonResponse(json_decode($serializer->serialize($joueurs, 'json'), true));
    }

    #[Route('/joueur/{ally_code}', name: 'get_joueur_by_ally_code', methods: ['GET'])]
    public function joueurId(JoueurRepository $joueurRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager): JsonResponse
    {
        $joueur = $joueurRepository->findOneBy(['ally_code' => $ally_code]);

        if (!$joueur) {
            $client = HttpClient::create(); 

            $response = $client->request('GET', str_replace("{ally_code}", $ally_code, $this->apiUrls['joueur']));
            $data = $response->toArray();

            if (!empty($data['data'])) {
                $joueur = new Joueur();
    
                $joueur->setAllyCode($data['data']['ally_code']);
                $joueur->setPseudo($data['data']['name']);
                $joueur->setTitre($data['data']['title']);
                $joueur->setNiveau($data['data']['level']);
                $joueur->setPgTotale($data['data']['galactic_power']);
                $joueur->setPgHeros($data['data']['character_galactic_power']);
                $joueur->setPgVaisseaux($data['data']['ship_galactic_power']);
                $joueur->setLienProfil($this->baseUrlSwgoh . $data['data']['url']);
                $joueur->setGuilde($data['data']['guild_id']);
                $joueur->setPortraitImage($data['data']['portrait_image']);
    
                $entityManager->persist($joueur);
                $entityManager->flush();
    
                $guilde_exists = $guildeRepository->findOneBy(['guilde_id' => $joueur->getGuilde()]);
            }
    
            if (!$guilde_exists) {
                $response_guilde = $client->request('GET', str_replace("{guilde_id}", $joueur->getGuilde(), $this->apiUrls['guilde']));
                $data_guilde = $response_guilde->toArray();
    
                $guilde = new Guilde();
    
                $guilde->setGuildeId($joueur->getGuilde());
                $guilde->setNom($data_guilde['data']['name']);
                $guilde->setPuissanceGuilde($data_guilde['data']['galactic_power']);
                $guilde->setNbJoueurs($data_guilde['data']['member_count']);
                
                $entityManager->persist($guilde);
                $entityManager->flush();
            }

            if (!empty($data['units'])) {
                foreach ($data['units'] as $hero_vaisseau) {
                    $joueurHeroVaisseau = new HeroVaisseau();

                    $joueurHeroVaisseau->setPlayerCode($joueur->getAllyCode());
                    $joueurHeroVaisseau->setNom($hero_vaisseau['data']['name']);
                    $joueurHeroVaisseau->setVie(intval($hero_vaisseau['data']['stats']['1']));
                    $joueurHeroVaisseau->setProtection(intval($hero_vaisseau['data']['stats']['28']));
                    $joueurHeroVaisseau->setVitesse(intval($hero_vaisseau['data']['stats']['5']));
                    $joueurHeroVaisseau->setPuissance(intval($hero_vaisseau['data']['power']));
                    $joueurHeroVaisseau->setTenacite($this->statsConversion($hero_vaisseau['data']['stats']['18'], 'calcPercentage'));
                    $joueurHeroVaisseau->setDegatPhysique(intval($hero_vaisseau['data']['stats']['6']));
                    $joueurHeroVaisseau->setCcPhysique($this->statsConversion($hero_vaisseau['data']['stats']['14'], '%'));
                    $joueurHeroVaisseau->setDegatSpeciaux(intval($hero_vaisseau['data']['stats']['7']));
                    $joueurHeroVaisseau->setCcSpeciaux($this->statsConversion($hero_vaisseau['data']['stats']['15'], '%'));
                    $joueurHeroVaisseau->setCombatType($hero_vaisseau['data']['combat_type']);
                    $joueurHeroVaisseau->setImage('');

                    if ($hero_vaisseau['data']['combat_type'] === 1) {
                        $joueurHeroVaisseau->setDegatCritique($this->statsConversion($hero_vaisseau['data']['stats']['16']));
                        $joueurHeroVaisseau->setVolVie($this->statsConversion($hero_vaisseau['data']['stats']['27']));
                    } 

                    $entityManager->persist($joueurHeroVaisseau);
                    $entityManager->flush();

                    unset($joueurHeroVaisseau);
                }
            }
        }

        return new JsonResponse(json_decode($serializer->serialize($joueur, 'json'), true));
    }

    #[Route('/{ally_code}/create', name: 'post_joueur', methods: ['POST'])]
    public function createJoueur(JoueurRepository $joueurRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager, GuildeRepository $guildeRepository): JsonResponse
    {
        $client = HttpClient::create();

        $response = $client->request('GET', str_replace("{ally_code}", $ally_code, $this->apiUrls['joueur']));
        $data = $response->toArray();

        if (!empty($data['data'])) {
            $joueur = new Joueur();

            $joueur->setAllyCode($data['data']['ally_code']);
            $joueur->setPseudo($data['data']['name']);
            $joueur->setTitre($data['data']['title']);
            $joueur->setNiveau($data['data']['level']);
            $joueur->setPgTotale($data['data']['galactic_power']);
            $joueur->setPgHeros($data['data']['character_galactic_power']);
            $joueur->setPgVaisseaux($data['data']['ship_galactic_power']);
            $joueur->setLienProfil($this->baseUrlSwgoh . $data['data']['url']);
            $joueur->setGuilde($data['data']['guild_id']);
            $joueur->setPortraitImage($data['data']['portrait_image']);

            $entityManager->persist($joueur);
            $entityManager->flush();

            $guilde_exists = $guildeRepository->findOneBy(['guilde_id' => $joueur->getGuilde()]);
        }

        if (!$guilde_exists) {
            $response_guilde = $client->request('GET', str_replace("{guilde_id}", $joueur->getGuilde(), $this->apiUrls['guilde']));
            $data_guilde = $response_guilde->toArray();

            $guilde = new Guilde();

            $guilde->setGuildeId($joueur->getGuilde());
            $guilde->setNom($data_guilde['data']['name']);
            $guilde->setPuissanceGuilde($data_guilde['data']['galactic_power']);
            $guilde->setNbJoueurs($data_guilde['data']['member_count']);
            
            $entityManager->persist($guilde);
            $entityManager->flush();

            foreach ($data_guilde['members'] as $member) {
                $joueur_guilde = new JoueurGuilde();

                $joueur->setAllyCode($member['ally_code']);
                $joueur->setPseudo($member['player_name']);
                $joueur->setPgTotale($member['galactic_power']);

                $entityManager->persist($joueur);
                $entityManager->flush();

                unset($joueur_guilde);
            }
        }

        if (!empty($data['units'])) {
            foreach ($data['units'] as $hero_vaisseau) {
                $joueurHeroVaisseau = new HeroVaisseau();

                $joueurHeroVaisseau->setPlayerCode($joueur->getAllyCode());
                $joueurHeroVaisseau->setNom($hero_vaisseau['data']['name']);
                $joueurHeroVaisseau->setVie(intval($hero_vaisseau['data']['stats']['1']));
                $joueurHeroVaisseau->setProtection(intval($hero_vaisseau['data']['stats']['28']));
                $joueurHeroVaisseau->setVitesse(intval($hero_vaisseau['data']['stats']['5']));
                $joueurHeroVaisseau->setPuissance(intval($hero_vaisseau['data']['power']));
                $joueurHeroVaisseau->setTenacite($this->statsConversion($hero_vaisseau['data']['stats']['18'], 'calcPercentage'));
                $joueurHeroVaisseau->setDegatPhysique(intval($hero_vaisseau['data']['stats']['6']));
                $joueurHeroVaisseau->setCcPhysique($this->statsConversion($hero_vaisseau['data']['stats']['14'], '%'));
                $joueurHeroVaisseau->setDegatSpeciaux(intval($hero_vaisseau['data']['stats']['7']));
                $joueurHeroVaisseau->setCcSpeciaux($this->statsConversion($hero_vaisseau['data']['stats']['15'], '%'));
                $joueurHeroVaisseau->setCombatType($hero_vaisseau['data']['combat_type']);
                $joueurHeroVaisseau->setImage('');

                if ($hero_vaisseau['data']['combat_type'] === 1) {
                    $joueurHeroVaisseau->setDegatCritique($this->statsConversion($hero_vaisseau['data']['stats']['16']));
                    $joueurHeroVaisseau->setVolVie($this->statsConversion($hero_vaisseau['data']['stats']['27']));
                } 

                $entityManager->persist($joueurHeroVaisseau);
                $entityManager->flush();

                unset($joueurHeroVaisseau);
            }
        }

        return new JsonResponse(json_decode($serializer->serialize($joueur, 'json'), true));
    }

    #[Route('/{ally_code}/update', name: 'put_joueur', methods: ['PUT'])]
    public function updateJoueur(Request $request, JoueurRepository $joueurRepository, SerializerInterface $serializer, int $ally_code, EntityManagerInterface $entityManager, GuildeRepository $guildeRepository): JsonResponse
    {
        $joueur = $joueurRepository->findOneBy(['ally_code' => $ally_code]);

        if ($joueur) {
            $content = $request->getContent();
            $data = json_decode($content, true);

            if (!empty($data['data'])) {
                $joueur = new Joueur();

                $joueur->setAllyCode($data['ally_code']);
                $joueur->setPseudo($data['name']);
                $joueur->setTitre($data['title']);
                $joueur->setNiveau($data['level']);
                $joueur->setPgTotale($data['galactic_power']);
                $joueur->setPgHeros($data['character_galactic_power']);
                $joueur->setPgVaisseaux($data['ship_galactic_power']);
                $joueur->setLienProfil($this->baseUrlSwgoh . $data['url']);
                $joueur->setGuilde($data['guild_id']);
                $joueur->setPortraitImage($data['portrait_image']);

                $entityManager->persist($joueur);
                $entityManager->flush();

                $guilde_exists = $guildeRepository->findOneBy(['guilde_id' => $joueur->getGuilde()]);
            }

            if (!$guilde_exists) {
                $response_guilde = $client->request('GET', str_replace("{guilde_id}", $joueur->getGuilde(), $this->apiUrls['guilde']));
                $data_guilde = $response_guilde->toArray();

                $guilde = new Guilde();

                $guilde->setGuildeId($joueur->getGuilde());
                $guilde->setNom($data_guilde['data']['name']);
                $guilde->setPuissanceGuilde($data_guilde['data']['galactic_power']);
                $guilde->setNbJoueurs($data_guilde['data']['member_count']);
                
                $entityManager->persist($guilde);
                $entityManager->flush();
            } else {
                $guilde = new Guilde();

                $guilde->setGuildeId($joueur->getGuilde());
                $guilde->setNom($data['guilde']['name']);
                $guilde->setPuissanceGuilde($data['guilde']['galactic_power']);
                $guilde->setNbJoueurs($data['guilde']['member_count']);
                
                $entityManager->persist($guilde);
                $entityManager->flush();
            }

            if (!empty($data['units'])) {
                foreach ($data['units'] as $hero_vaisseau) {
                    $joueurHeroVaisseau = new HeroVaisseau();

                    $joueurHeroVaisseau->setPlayerCode($joueur->getAllyCode());
                    $joueurHeroVaisseau->setNom($hero_vaisseau['data']['name']);
                    $joueurHeroVaisseau->setVie(intval($hero_vaisseau['data']['stats']['1']));
                    $joueurHeroVaisseau->setProtection(intval($hero_vaisseau['data']['stats']['28']));
                    $joueurHeroVaisseau->setVitesse(intval($hero_vaisseau['data']['stats']['5']));
                    $joueurHeroVaisseau->setPuissance(intval($hero_vaisseau['data']['power']));
                    $joueurHeroVaisseau->setTenacite($this->statsConversion($hero_vaisseau['data']['stats']['18'], 'calcPercentage'));
                    $joueurHeroVaisseau->setDegatPhysique(intval($hero_vaisseau['data']['stats']['6']));
                    $joueurHeroVaisseau->setCcPhysique($this->statsConversion($hero_vaisseau['data']['stats']['14'], '%'));
                    $joueurHeroVaisseau->setDegatSpeciaux(intval($hero_vaisseau['data']['stats']['7']));
                    $joueurHeroVaisseau->setCcSpeciaux($this->statsConversion($hero_vaisseau['data']['stats']['15'], '%'));
                    $joueurHeroVaisseau->setCombatType($hero_vaisseau['data']['combat_type']);
                    $joueurHeroVaisseau->setImage('');

                    if ($hero_vaisseau['data']['combat_type'] === 1) {
                        $joueurHeroVaisseau->setDegatCritique($this->statsConversion($hero_vaisseau['data']['stats']['16']));
                        $joueurHeroVaisseau->setVolVie($this->statsConversion($hero_vaisseau['data']['stats']['27']));
                    } 

                    $entityManager->persist($joueurHeroVaisseau);
                    $entityManager->flush();

                    unset($joueurHeroVaisseau);
                }
            }

            return new JsonResponse(['message' => 'Player updated successfully!']);
        }

        return new JsonResponse(['message' => 'No Player found!']);
    }

    public function statsConversion($stat, $output = 'calcInt') {
        if ($output === 'calcPercentage') return number_format(($stat * 100), 2, '.', '');
        elseif ($output === '%') return number_format($stat, 2, '.', '');
        else return intval($stat * 100);
    }
}
