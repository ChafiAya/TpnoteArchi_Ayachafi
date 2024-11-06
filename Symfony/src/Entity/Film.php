<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_film = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column]
    private ?int $annee_sortie = null;

    /**
     * @var Collection<int, Acteur>
     */
    #[ORM\OneToMany(targetEntity: Acteur::class, mappedBy: 'id_film')]
    private Collection $id_acteur;

    #[ORM\ManyToOne(inversedBy: 'id_film')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Realisateur $id_realisateur = null;

    #[ORM\ManyToOne(inversedBy: 'id_film')]
    private ?Utilisateur $utilisateur = null;

    public function __construct()
    {
        $this->id_acteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFilm(): ?int
    {
        return $this->id_film;
    }

    public function setIdFilm(int $id_film): static
    {
        $this->id_film = $id_film;

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

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAnneeSortie(): ?int
    {
        return $this->annee_sortie;
    }

    public function setAnneeSortie(int $annee_sortie): static
    {
        $this->annee_sortie = $annee_sortie;

        return $this;
    }

    /**
     * @return Collection<int, Acteur>
     */
    public function getIdActeur(): Collection
    {
        return $this->id_acteur;
    }

    public function addIdActeur(Acteur $idActeur): static
    {
        if (!$this->id_acteur->contains($idActeur)) {
            $this->id_acteur->add($idActeur);
            $idActeur->setIdFilm($this);
        }

        return $this;
    }

    public function removeIdActeur(Acteur $idActeur): static
    {
        if ($this->id_acteur->removeElement($idActeur)) {
            // set the owning side to null (unless already changed)
            if ($idActeur->getIdFilm() === $this) {
                $idActeur->setIdFilm(null);
            }
        }

        return $this;
    }

    public function getIdRealisateur(): ?Realisateur
    {
        return $this->id_realisateur;
    }

    public function setIdRealisateur(?Realisateur $id_realisateur): static
    {
        $this->id_realisateur = $id_realisateur;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
