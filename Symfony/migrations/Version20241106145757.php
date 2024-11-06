<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106145757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acteur (id INT AUTO_INCREMENT NOT NULL, id_film_id INT NOT NULL, id_acteur INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, role_a VARCHAR(255) NOT NULL, datenaissance DATE NOT NULL, INDEX IDX_EAFAD36288E2F8F3 (id_film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, id_realisateur_id INT NOT NULL, utilisateur_id INT DEFAULT NULL, id_film INT NOT NULL, titre VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, annee_sortie INT NOT NULL, INDEX IDX_8244BE22CCBEFF28 (id_realisateur_id), INDEX IDX_8244BE22FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisateur (id INT AUTO_INCREMENT NOT NULL, id_realisateur INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, id_utilisateur INT NOT NULL, nom_utilisateur VARCHAR(244) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acteur ADD CONSTRAINT FK_EAFAD36288E2F8F3 FOREIGN KEY (id_film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22CCBEFF28 FOREIGN KEY (id_realisateur_id) REFERENCES realisateur (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acteur DROP FOREIGN KEY FK_EAFAD36288E2F8F3');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22CCBEFF28');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22FB88E14F');
        $this->addSql('DROP TABLE acteur');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE realisateur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
