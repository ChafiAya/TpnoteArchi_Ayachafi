<?php

class Acteur {
    
    private int $id;
    private string $nom;
    private string $prenom;
    private string $roleA;
    private DateTime $dateNaissance;
    

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRoleA(): string
    {
        return $this->roleA;
    }

    public function setRoleA(string $roleA): self
    {
        $this->roleA = $roleA;

        return $this;
    }

    public function getDateNaissance(): DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(DateTime $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }
}
?>
