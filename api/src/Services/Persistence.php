<?php

namespace App\Services;

class Persistence {


    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function insertJoueur($data) {
        $joueur = new Joueur();

        $joueur->setAllyCode($data['ally_code']);
        $joueur->setPseudo($data['name']);
        $joueur->setTitre($data['title']);
        $joueur->setNiveau($data['level']);
        $joueur->setPgTotale($data['galactic_power']);
        $joueur->setPgHeros($data['character_galactic_power']);
        $joueur->setPgVaisseaux($data['ship_galactic_power']);
        $joueur->setLienProfil($data['url']);
        $joueur->setGuilde($data['guild_id']);
        $joueur->setPortraitImage($data['portrait_image']);

       return $joueur;
    }

    public function insertJoueurGuilde($data) {
        $joueur_guilde = new JoueurGuilde();

        $joueur_guilde->setAllyCode($data['ally_code']);
        $joueur_guilde->setPseudo($data['name']);
        $joueur_guilde->setPgTotale($data['galactic_power']);
        $joueur_guilde->setGuilde($data['guild_id']);

       return $joueur_guilde;
    }

    public function insertHeroVaisseau($hero_vaisseau, $joueur) {
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

        if ($hero_vaisseau['data']['combat_type'] === 1) {
            $joueurHeroVaisseau->setDegatCritique($this->statsConversion($hero_vaisseau['data']['stats']['16']));
            $joueurHeroVaisseau->setVolVie($this->statsConversion($hero_vaisseau['data']['stats']['27']));
        } 
    }

    public function insertGuilde($data) {
        $guilde = new Guilde();

        $guilde->setId($data['ally_code']);
        $guilde->setNom($data['name']);
        $guilde->setPuissanceGuilde($data['galactic_power']);
        $guilde->setNbJoueurs($data['guild_id']);

       return $guilde;
    }

    public function statsConversion($stat, $output = 'calcInt') {
        if ($output === 'calcPercentage') return number_format(($stat * 100), 2, '.', '');
        elseif ($output === '%') return number_format($stat, 2, '.', '');
        else return intval($stat * 100);
    }
}
