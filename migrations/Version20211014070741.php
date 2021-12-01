<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211014070741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livret_heure CHANGE abs_maladie abs_maladie TINYINT(1) NOT NULL, CHANGE cp cp TINYINT(1) NOT NULL, CHANGE formation formation TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livret_heure CHANGE abs_maladie abs_maladie TINYINT(1) DEFAULT NULL, CHANGE cp cp TINYINT(1) DEFAULT NULL, CHANGE formation formation TINYINT(1) DEFAULT NULL');
    }
}
