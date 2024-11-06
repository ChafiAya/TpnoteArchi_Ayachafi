<?php
include_once 'php/Realisateur.php';
include_once 'php/Connexion.php';

class RealisateurDao {

    public function ajouterRealisateur($Realisateur) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("INSERT INTO Realisateur ( Nom, Prenom) VALUES (:Nom, :Prenom)");
            $sth->execute(array (
                
                'Nom' => $Realisateur->getNom(),
                'Prenom' => $Realisateur->getPrenom(),
            ));
            return 'Record added successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function listerRealisateurs() {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("SELECT * FROM Realisateur");
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            $tab = array();
            foreach ($rows as $row) {
                $Realisateur = new Realisateur();
                $Realisateur->setId($row['Id']);
                $Realisateur->setNom($row['Nom']);
                $Realisateur->setPrenom($row['Prenom']);
                array_push($tab, $Realisateur);
            }

            return $tab;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function recupererRealisateur($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "SELECT * FROM Realisateur WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $edition = new Realisateur();
                $edition->setId($data['Id']);
                $edition->setNom($data['Nom']);
                $edition->setPrenom($data['Prenom']);
                return $edition;
            }
            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function modifierRealisateur($edition) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("UPDATE Realisateur SET Id = :Id, Nom = :Nom, Prenom = :Prenom WHERE Id = :uniqueValue");
            $sth->execute(array (
                ':Id' => $edition->setId(),
                ':Nom' => $edition->setNom(),
                ':Prenom' => $edition->setPrenom(),
                ':uniqueValue' => $edition->getId()
            ));
            return 'Record updated successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function supprimerRealisateur($value, $property) {
        $conn = new Connexion();
        try {
           
            $sql = "DELETE FROM Film WHERE id_realisateur = :value";
            $delete = $conn->getConn()->prepare($sql);
            $delete->execute([':value' => $value]);

            $sqlD= "DELETE FROM Realisateur WHERE $property = :value";
            $st = $conn->getConn()->prepare($sqlD);
            $st->execute([':value' => $value]);
    
            return 'deleted successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
  
}
