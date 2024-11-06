<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_utilisateur = null;

    #[ORM\Column(length: 244)]
    private ?string $Nom_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\OneToMany(targetEntity: Film::class, mappedBy: 'utilisateur')]
    private Collection $id_film;

    public function __construct()
    {
        $this->id_film = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(int $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->Nom_utilisateur;
    }

    public function setNomUtilisateur(string $Nom_utilisateur): static
    {
        $this->Nom_utilisateur = $Nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->Prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $Prenom_utilisateur): static
    {
        $this->Prenom_utilisateur = $Prenom_utilisateur;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

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
            $idFilm->setUtilisateur($this);
        }

        return $this;
    }

    public function removeIdFilm(Film $idFilm): static
    {
        if ($this->id_film->removeElement($idFilm)) {
            // set the owning side to null (unless already changed)
            if ($idFilm->getUtilisateur() === $this) {
                $idFilm->setUtilisateur(null);
            }
        }

        return $this;
    }
}
