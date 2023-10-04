<?php

namespace App\Entity;

use App\Repository\HeroVaisseauRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeroVaisseauRepository::class)]
class HeroVaisseau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $player_code = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $vie = null;

    #[ORM\Column]
    private ?int $protection = null;

    #[ORM\Column]
    private ?int $vitesse = null;

    #[ORM\Column(nullable: true)]
    private ?int $degat_critique = null;

    #[ORM\Column]
    private ?int $puissance = null;

    #[ORM\Column]
    private ?float $tenacite = null;

    #[ORM\Column(nullable: true)]
    private ?int $vol_vie = null;

    #[ORM\Column]
    private ?int $degat_physique = null;

    #[ORM\Column]
    private ?float $cc_physique = null;

    #[ORM\Column]
    private ?int $degat_speciaux = null;

    #[ORM\Column]
    private ?float $cc_speciaux = null;

    #[ORM\Column]
    private ?int $combat_type = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerCode(): ?int
    {
        return $this->player_code;
    }

    public function setPlayerCode(int $player_code): static
    {
        $this->player_code = $player_code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVie(): ?int
    {
        return $this->vie;
    }

    public function setVie(int $vie): static
    {
        $this->vie = $vie;

        return $this;
    }

    public function getProtection(): ?int
    {
        return $this->protection;
    }

    public function setProtection(int $protection): static
    {
        $this->protection = $protection;

        return $this;
    }

    public function getVitesse(): ?int
    {
        return $this->vitesse;
    }

    public function setVitesse(int $vitesse): static
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getDegatCritique(): ?int
    {
        return $this->degat_critique;
    }

    public function setDegatCritique(?int $degat_critique): static
    {
        $this->degat_critique = $degat_critique;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): static
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getTenacite(): ?float
    {
        return $this->tenacite;
    }

    public function setTenacite(float $tenacite): static
    {
        $this->tenacite = $tenacite;

        return $this;
    }

    public function getVolVie(): ?int
    {
        return $this->vol_vie;
    }

    public function setVolVie(?int $vol_vie): static
    {
        $this->vol_vie = $vol_vie;

        return $this;
    }

    public function getDegatPhysique(): ?int
    {
        return $this->degat_physique;
    }

    public function setDegatPhysique(int $degat_physique): static
    {
        $this->degat_physique = $degat_physique;

        return $this;
    }

    public function getCcPhysique(): ?float
    {
        return $this->cc_physique;
    }

    public function setCcPhysique(float $cc_physique): static
    {
        $this->cc_physique = $cc_physique;

        return $this;
    }

    public function getDegatSpeciaux(): ?int
    {
        return $this->degat_speciaux;
    }

    public function setDegatSpeciaux(int $degat_speciaux): static
    {
        $this->degat_speciaux = $degat_speciaux;

        return $this;
    }

    public function getCcSpeciaux(): ?float
    {
        return $this->cc_speciaux;
    }

    public function setCcSpeciaux(float $cc_speciaux): static
    {
        $this->cc_speciaux = $cc_speciaux;

        return $this;
    }

    public function getCombatType(): ?int
    {
        return $this->combat_type;
    }

    public function setCombatType(int $combat_type): static
    {
        $this->combat_type = $combat_type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
