<?php
include_once './Acteur.php';
include_once './Connexion.php';

class ActeurDao {

    public function ajouterActeur($Acteur) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("INSERT INTO Acteur (id, nom, prenom, roleA, dateNaissance) VALUES (:id, :nom, :prenom, :roleA, :dateNaissance)");
            $sth->execute(array (
                'Id' => $Acteur->getId(),
                'Nom' => $Acteur->getNom(),
                'Prenom' => $Acteur->getPrenom(),
                'RoleA' => $Acteur->getRoleA(),
                'DateNaissance' => $Acteur->getDateNaissance(),
            ));
            return 'Record added successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function listerActeurs() {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("SELECT * FROM Acteur");
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            $tab = array();
            foreach ($rows as $row) {
                $Acteur = new Acteur();
                $Acteur->setId($row['Id']);
                $Acteur->setNom($row['Nom']);
                $Acteur->setPrenom($row['Prenom']);
                $Acteur->setRoleA($row['RoleA']);
                $Acteur->setDateNaissance($row['DateNaissance']);
                array_push($tab, $Acteur);
            }

            return $tab;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function recupererActeur($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "SELECT * FROM Acteur WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $edition = new Acteur();
                $edition->setId($data['Id']);
                $edition->setNom($data['Nom']);
                $edition->setPrenom($data['Prenom']);
                $edition->setRoleA($data['RoleA']);
                $edition->setDateNaissance($data['DateNaissance']);
                return $edition;
            }
            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function modifierActeur($edition) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("UPDATE Acteur SET Id = :Id, Nom = :Nom, Prenom = :Prenom, RoleA = :RoleA, DateNaissance = :DateNaissance WHERE Id = :uniqueValue");
            $sth->execute(array (
                ':Id' => $edition->setId(),
                ':Nom' => $edition->setNom(),
                ':Prenom' => $edition->setPrenom(),
                ':RoleA' => $edition->setRoleA(),
                ':DateNaissance' => $edition->setDateNaissance(),
                ':uniqueValue' => $edition->getId()
            ));
            return 'Record updated successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function supprimerActeur($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "DELETE FROM Acteur WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            return 'Record deleted successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
