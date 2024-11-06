<?php

include_once 'php/Realisateur.php';
include_once 'php/RealisateurDao.php';


function Ajouter() {
    $Dao = new RealisateurDao();
    $a = new  Realisateur ();
    $a->setNom("Realisateur1");
    $a->setPrenom("Realisateur1");
    $result = $Dao->ajouterRealisateur($a);
    echo "Add collection: " . $result . "\n";

    $a2 = new Realisateur ();
    $a2->setNom("Realisateur2");
    $a2->setPrenom("Realisateur1");
    $result2 = $Dao->ajouterRealisateur($a2);
    echo "Add collection2: " . $result2 . "\n";

}


function Lister() {
    $Dao = new RealisateurDao();
    $result = $Dao->listerRealisateurs();

    if (is_array($result)) {
        echo "List Collections:\n";
        foreach ($result as $collection) {
            echo "id: " . $collection->getId() . ", Nom: " . $collection->getNom() . ", Prenom: " . $collection->getPrenom() . "\n";
        }
    } else {
        echo "List Collections: " . $result . "\n";
    }
}

function Recuperer(){
    $Dao = new RealisateurDao();
    $result = $Dao->recupererRealisateur(1, 'Id'); 

    if ($result) {
        echo "Retrieve : id: " . $result->getNom() . ", Nom: " . $result->getPrenom(). "\n";
    } else {
        echo "Retrieve collection No collection found.\n";
    }
}




Ajouter();
Lister();
Recuperer();
?>
