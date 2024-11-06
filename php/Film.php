<?php

class Film{
    
    private int $Id;
    private string $titre;
    private string $durée;
    private int $id_realisateur;
    private int $id_acteur;
    private int $annéeS  ;
    

    public function getId(): int
    {
        return $this->Id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

  

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDurée(): string
    {
        return $this->durée;
    }

    public function setDurée(string $durée): self
    {
        $this->durée = $durée;

        return $this;
    }

    public function getIdRealisateur(): int
    {
        return $this->id_realisateur;
    }

    public function setIdRealisateur(int $id_realisateur): self
    {
        $this->id_realisateur = $id_realisateur;

        return $this;
    }

    public function getIdActeur(): int
    {
        return $this->id_acteur;
    }

    public function setIdActeur(int $id_acteur): self
    {
        $this->id_acteur = $id_acteur;

        return $this;
    }

    public function getAnnéeS(): int
    {
        return $this->annéeS;
    }

    public function setAnnéeS(int $annéeS): self
    {
        $this->annéeS = $annéeS;

        return $this;
    }
}
?>
