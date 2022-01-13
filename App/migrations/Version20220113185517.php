<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113185517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bases_de_defense CHANGE id_rfz id_rfz INT DEFAULT NULL, CHANGE id_contact id_contact INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bnr CHANGE id_organisme id_organisme INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internet_militaire CHANGE id_organisme id_organisme INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modip CHANGE id_quartier id_quartier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opera CHANGE id_quartier id_quartier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE organisme CHANGE id_quartier id_quartier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quartiers CHANGE id_base_defense id_base_defense INT DEFAULT NULL');
        $this->addSql('ALTER TABLE travaux_opera CHANGE id_opera id_opera INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP role_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bases_de_defense CHANGE id_rfz id_rfz INT NOT NULL, CHANGE id_contact id_contact INT NOT NULL');
        $this->addSql('ALTER TABLE bnr CHANGE id_organisme id_organisme INT NOT NULL');
        $this->addSql('ALTER TABLE internet_militaire CHANGE id_organisme id_organisme INT NOT NULL');
        $this->addSql('ALTER TABLE modip CHANGE id_quartier id_quartier INT NOT NULL');
        $this->addSql('ALTER TABLE opera CHANGE id_quartier id_quartier INT NOT NULL');
        $this->addSql('ALTER TABLE organisme CHANGE id_quartier id_quartier INT NOT NULL');
        $this->addSql('ALTER TABLE quartiers CHANGE id_base_defense id_base_defense INT NOT NULL');
        $this->addSql('ALTER TABLE travaux_opera CHANGE id_opera id_opera INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD role_user VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, DROP roles');
    }
}
