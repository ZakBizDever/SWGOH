<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JoueurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
#[ApiResource]
class Joueur
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $ally_code = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $niveau = null;

    #[ORM\Column]
    private ?int $pg_totale = null;

    #[ORM\Column]
    private ?int $pg_heros = null;

    #[ORM\Column]
    private ?int $pg_vaisseaux = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $lien_profil = null;

    #[ORM\Column(length: 255)]
    private ?string $guilde = null;

    #[ORM\Column(length: 255)]
    private ?string $portrait_image = null;

    public function getAllyCode(): ?int
    {
        return $this->ally_code;
    }

    public function setAllyCode(string $ally_code): static
    {
        $this->ally_code = $ally_code;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getPgTotale(): ?int
    {
        return $this->pg_totale;
    }

    public function setPgTotale(int $pg_totale): static
    {
        $this->pg_totale = $pg_totale;

        return $this;
    }

    public function getPgHeros(): ?int
    {
        return $this->pg_heros;
    }

    public function setPgHeros(int $pg_heros): static
    {
        $this->pg_heros = $pg_heros;

        return $this;
    }

    public function getPgVaisseaux(): ?int
    {
        return $this->pg_vaisseaux;
    }

    public function setPgVaisseaux(int $pg_vaisseaux): static
    {
        $this->pg_vaisseaux = $pg_vaisseaux;

        return $this;
    }

    public function getLienProfil(): ?string
    {
        return $this->lien_profil;
    }

    public function setLienProfil(string $lien_profil): static
    {
        $this->lien_profil = $lien_profil;

        return $this;
    }

    public function getGuilde(): ?string
    {
        return $this->guilde;
    }

    public function setGuilde(string $guilde): static
    {
        $this->guilde = $guilde;

        return $this;
    }

    public function getPortraitImage(): ?string
    {
        return $this->portrait_image;
    }

    public function setPortraitImage(string $portrait_image): static
    {
        $this->portrait_image = $portrait_image;

        return $this;
    }
}
