<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GuildeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuildeRepository::class)]
#[ApiResource]
class Guilde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $guilde_id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $puissance_guilde = null;

    #[ORM\Column]
    private ?int $nb_joueurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuildeID(): ?string
    {
        return $this->guilde_id;
    }

    public function setGuildeId(string $guilde_id): static
    {
        $this->guilde_id = $guilde_id;

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

    public function getPuissanceGuilde(): ?int
    {
        return $this->puissance_guilde;
    }

    public function setPuissanceGuilde(int $puissance_guilde): static
    {
        $this->puissance_guilde = $puissance_guilde;

        return $this;
    }

    public function getNbJoueurs(): ?int
    {
        return $this->nb_joueurs;
    }

    public function setNbJoueurs(int $nb_joueurs): static
    {
        $this->nb_joueurs = $nb_joueurs;

        return $this;
    }
}
