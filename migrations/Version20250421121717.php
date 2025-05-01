<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421121717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql(<<<'SQL'
            ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBBF396750 FOREIGN KEY (id) REFERENCES personne (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB6A8E9A42 FOREIGN KEY (personne_de_confiance) REFERENCES personne (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBEBA6D43E FOREIGN KEY (infirmiere_souhait) REFERENCES infirmiere (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne_login ADD role_metier VARCHAR(20) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE soins CHANGE date date DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_soins DROP FOREIGN KEY type_soins_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE visite DROP FOREIGN KEY visite_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE visite DROP FOREIGN KEY visite_ibfk_2
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE infirmiere CHANGE id id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE soins CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
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
            ALTER TABLE personne_login DROP role_metier
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_soins ADD CONSTRAINT type_soins_ibfk_1 FOREIGN KEY (id_categ_soins) REFERENCES categ_soins (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE visite ADD CONSTRAINT visite_ibfk_1 FOREIGN KEY (patient) REFERENCES patient (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE visite ADD CONSTRAINT visite_ibfk_2 FOREIGN KEY (infirmiere) REFERENCES infirmiere (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
    }
}
