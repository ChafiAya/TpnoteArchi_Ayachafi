<?php
include './Film.php';
include_once './Connexion.php';

class FilmDao {

    public function ajouterFilm($Film) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("INSERT INTO Film (Id, titre, durée, id_realisateur, id_acteur, annéeS) VALUES (:Id, :titre, :durée, :id_realisateur, :id_acteur, :annéeS)");
            $sth->execute(array (
                'Id' => $Film->getId(),
                'Titre' => $Film->getTitre(),
                'Durée' => $Film->getDurée(),
                'IdRealisateur' => $Film->getIdRealisateur(),
                'IdActeur' => $Film->getIdActeur(),
                'AnnéeS' => $Film->getAnnéeS(),
            ));
            return 'Record added successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function listerFilms() {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("SELECT * FROM Film");
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            $tab = array();
            foreach ($rows as $row) {
                $Film = new Film();
                $Film->setId($row['Id']);
                $Film->setTitre($row['Titre']);
                $Film->setDurée($row['Durée']);
                $Film->setIdRealisateur($row['IdRealisateur']);
                $Film->setIdActeur($row['IdActeur']);
                $Film->setAnnéeS($row['AnnéeS']);
                array_push($tab, $Film);
            }

            return $tab;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function recupererFilm($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "SELECT * FROM Film WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $edition = new Film();
                $edition->setId($data['Id']);
                $edition->setTitre($data['Titre']);
                $edition->setDurée($data['Durée']);
                $edition->setIdRealisateur($data['IdRealisateur']);
                $edition->setIdActeur($data['IdActeur']);
                $edition->setAnnéeS($data['AnnéeS']);
                return $edition;
            }
            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function modifierFilm($edition) {
        $conn = new Connexion();
        try {
            $sth = $conn->getConn()->prepare("UPDATE Film SET Id = :Id, Titre = :Titre, Durée = :Durée, IdRealisateur = :IdRealisateur, IdActeur = :IdActeur, AnnéeS = :AnnéeS WHERE Id = :uniqueValue");
            $sth->execute(array (
                ':Id' => $edition->setId(),
                ':Titre' => $edition->setTitre(),
                ':Durée' => $edition->setDurée(),
                ':IdRealisateur' => $edition->setIdRealisateur(),
                ':IdActeur' => $edition->setIdActeur(),
                ':AnnéeS' => $edition->setAnnéeS(),
                ':uniqueValue' => $edition->getId()
            ));
            return 'Record updated successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function supprimerFilm($value, $property) {
        $conn = new Connexion();
        try {
            $sql = "DELETE FROM Film WHERE $property = :value";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([':value' => $value]);
            return 'Record deleted successfully.';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
