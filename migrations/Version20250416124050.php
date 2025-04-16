<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416124050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(25) NOT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE categ_soins (id INT AUTO_INCREMENT NOT NULL, libel LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE categorie_indisponibilite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(250) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chambre_forte (badge VARCHAR(25) NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, acces_ok TINYINT(1) NOT NULL, PRIMARY KEY(badge, date)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE convalescence (id_patient INT NOT NULL, id_lieux INT NOT NULL, date_deb DATE NOT NULL, date_fin DATE DEFAULT NULL, chambre VARCHAR(50) DEFAULT NULL, tel_directe CHAR(10) DEFAULT NULL, INDEX id_lieux (id_lieux), PRIMARY KEY(id_patient, id_lieux, date_deb)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE indisponibilite (infirmiere INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, heure_deb TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, categorie INT NOT NULL, INDEX infirmiere (infirmiere), INDEX categorie (categorie), PRIMARY KEY(infirmiere, date_debut)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE infirmiere (id INT AUTO_INCREMENT NOT NULL, fichier_photo VARCHAR(250) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE patient (id INT NOT NULL, personne_de_confiance INT DEFAULT NULL, infirmiere_souhait INT DEFAULT NULL, informations_medicales TEXT NOT NULL, INDEX personne_de_confiance (personne_de_confiance), INDEX infirmiere_souhait (infirmiere_souhait), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, sexe CHAR(1) NOT NULL, date_naiss DATE DEFAULT NULL, date_deces DATE DEFAULT NULL, ad1 VARCHAR(100) DEFAULT NULL, ad2 VARCHAR(100) DEFAULT NULL, cp INT DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, tel_fixe VARCHAR(15) DEFAULT NULL, tel_port VARCHAR(15) DEFAULT NULL, mail VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE personne_login (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(25) NOT NULL, mp VARCHAR(64) NOT NULL, derniere_connexion DATE DEFAULT NULL, UNIQUE INDEX UNIQ_BEE9DA79AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE soins (id_categ_soins INT NOT NULL, id_type_soins INT NOT NULL, id INT NOT NULL, libel TEXT NOT NULL, description TEXT DEFAULT NULL, coefficient DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX id_categ_soins (id_categ_soins), INDEX id_type_soins (id_type_soins), PRIMARY KEY(id_categ_soins, id_type_soins, id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE soins_visite (visite INT NOT NULL, id_categ_soins INT NOT NULL, id_type_soins INT NOT NULL, id_soins INT NOT NULL, prevu TINYINT(1) NOT NULL, realise TINYINT(1) NOT NULL, INDEX FK1 (id_categ_soins, id_type_soins, id_soins), INDEX visite (visite), INDEX id_soins (id_soins), INDEX id_categ_soins (id_categ_soins), INDEX id_type_soins (id_type_soins), PRIMARY KEY(visite, id_categ_soins, id_type_soins, id_soins)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE temoignage (id INT AUTO_INCREMENT NOT NULL, personne_login INT NOT NULL, contenu MEDIUMTEXT NOT NULL, date DATETIME NOT NULL, valide TINYINT(1) NOT NULL, INDEX personne_login (personne_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, id_login INT NOT NULL, date DATETIME NOT NULL, jeton TEXT NOT NULL, INDEX id_login (id_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type_soins (id_categ_soins INT NOT NULL, id_type_soins INT NOT NULL, libel TEXT NOT NULL, description TEXT DEFAULT NULL, INDEX id_categ_soins (id_categ_soins), INDEX id_type_soins (id_type_soins), PRIMARY KEY(id_categ_soins, id_type_soins)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, patient INT NOT NULL, infirmiere INT NOT NULL, date_prevue DATETIME NOT NULL, date_reelle DATETIME DEFAULT NULL, duree INT NOT NULL, compte_rendu_infirmiere TEXT DEFAULT NULL, compte_rendu_patient TEXT DEFAULT NULL, INDEX patient (patient), INDEX infirmiere (infirmiere), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBBF396750 FOREIGN KEY (id) REFERENCES personne (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB6A8E9A42 FOREIGN KEY (personne_de_confiance) REFERENCES personne (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBEBA6D43E FOREIGN KEY (infirmiere_souhait) REFERENCES infirmiere (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBBF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB6A8E9A42
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBEBA6D43E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE badge
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categ_soins
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categorie_indisponibilite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chambre_forte
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE convalescence
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE indisponibilite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE infirmiere
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE patient
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE personne
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE personne_login
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE soins
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE soins_visite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE temoignage
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE token
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_soins
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE visite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
