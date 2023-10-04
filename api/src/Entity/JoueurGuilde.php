<?php

namespace App\Entity;

use App\Repository\JoueurGuildeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurGuildeRepository::class)]
class JoueurGuilde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ally_code = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column]
    private ?int $pg_totale = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAllyCode(): ?int
    {
        return $this->ally_code;
    }

    public function setAllyCode(int $ally_code): static
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

    public function getPgTotale(): ?int
    {
        return $this->pg_totale;
    }

    public function setPgTotale(int $pg_totale): static
    {
        $this->pg_totale = $pg_totale;

        return $this;
    }
}
