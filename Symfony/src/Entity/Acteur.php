<?php

namespace App\Entity;

use App\Repository\ActeurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActeurRepository::class)]
class Acteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_acteur = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $roleA = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datenaissance = null;

    #[ORM\ManyToOne(inversedBy: 'id_acteur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Film $id_film = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActeur(): ?int
    {
        return $this->id_acteur;
    }

    public function setIdActeur(int $id_acteur): static
    {
        $this->id_acteur = $id_acteur;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getRoleA(): ?string
    {
        return $this->roleA;
    }

    public function setRoleA(string $roleA): static
    {
        $this->roleA = $roleA;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): static
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getIdFilm(): ?Film
    {
        return $this->id_film;
    }

    public function setIdFilm(?Film $id_film): static
    {
        $this->id_film = $id_film;

        return $this;
    }
}
