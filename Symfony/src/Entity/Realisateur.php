<?php

namespace App\Entity;

use App\Repository\RealisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisateurRepository::class)]
class Realisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_realisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\OneToMany(targetEntity: Film::class, mappedBy: 'id_realisateur')]
    private Collection $id_film;

    public function __construct()
    {
        $this->id_film = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRealisateur(): ?int
    {
        return $this->id_realisateur;
    }

    public function setIdRealisateur(int $id_realisateur): static
    {
        $this->id_realisateur = $id_realisateur;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getIdFilm(): Collection
    {
        return $this->id_film;
    }

    public function addIdFilm(Film $idFilm): static
    {
        if (!$this->id_film->contains($idFilm)) {
            $this->id_film->add($idFilm);
            $idFilm->setIdRealisateur($this);
        }

        return $this;
    }

    public function removeIdFilm(Film $idFilm): static
    {
        if ($this->id_film->removeElement($idFilm)) {
            // set the owning side to null (unless already changed)
            if ($idFilm->getIdRealisateur() === $this) {
                $idFilm->setIdRealisateur(null);
            }
        }

        return $this;
    }
}
