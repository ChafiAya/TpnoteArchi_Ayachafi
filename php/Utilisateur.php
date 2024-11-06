<?php

class Utilisateur {
    
    private int $Id;
    private string $Nom;
    private string $Prenom;
    private int $Email;
    private int $mdp;
    private int $id_film ;
    


    public function getIdFilm(): int
    {
        return $this->id_film;
    }

    public function setIdFilm(int $id_film): self
    {
        $this->id_film = $id_film;

        return $this;
    }

    public function getNom(): string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getPrenom(): string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): int
    {
        return $this->Email;
    }

    public function setEmail(int $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getMdp(): int
    {
        return $this->mdp;
    }

    public function setMdp(int $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }
}
?>
