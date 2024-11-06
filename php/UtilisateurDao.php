<?php
include './Utilisateur.php';
include_once './Connexion.php';

class UtilisateurDao {

    public function ajouterUtilisateur($Utilisateur) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("INSERT INTO Utilisateur (Nom, Prenom, Email, mdp, id_film) VALUES ( :Nom, :Prenom, :Email, :mdp, :id_film)");
            $sth->execute(array (
               
                'Nom' => $Utilisateur->getNom(),
                'Id' => $Utilisateur->getId(),
                'Prenom' => $Utilisateur->getPrenom(),
                'Email' => $Utilisateur->getEmail(),
                'Mdp' => $Utilisateur->getMdp(),
            ));
            return 'Record added successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function listerUtilisateurs() {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("SELECT * FROM Utilisateur");
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            $tab = array();
            foreach ($rows as $row) {
                $Utilisateur = new Utilisateur();
                $Utilisateur->setIdFilm($row['IdFilm']);
                $Utilisateur->setNom($row['Nom']);
                $Utilisateur->setId($row['Id']);
                $Utilisateur->setPrenom($row['Prenom']);
                $Utilisateur->setEmail($row['Email']);
                $Utilisateur->setMdp($row['Mdp']);
                array_push($tab, $Utilisateur);
            }

            return $tab;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function recupererUtilisateur($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "SELECT * FROM Utilisateur WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $edition = new Utilisateur();
                $edition->setIdFilm($data['IdFilm']);
                $edition->setNom($data['Nom']);
                $edition->setId($data['Id']);
                $edition->setPrenom($data['Prenom']);
                $edition->setEmail($data['Email']);
                $edition->setMdp($data['Mdp']);
                return $edition;
            }
            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function modifierUtilisateur($edition) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("UPDATE Utilisateur SET IdFilm = :IdFilm, Nom = :Nom, Id = :Id, Prenom = :Prenom, Email = :Email, Mdp = :Mdp WHERE IdFilm = :uniqueValue");
            $sth->execute(array (
                ':IdFilm' => $edition->setIdFilm(),
                ':Nom' => $edition->setNom(),
                ':Id' => $edition->setId(),
                ':Prenom' => $edition->setPrenom(),
                ':Email' => $edition->setEmail(),
                ':Mdp' => $edition->setMdp(),
                ':uniqueValue' => $edition->getIdFilm()
            ));
            return 'Record updated successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function supprimerUtilisateur($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "DELETE FROM Utilisateur WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            return 'Record deleted successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
