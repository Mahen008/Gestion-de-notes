<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205120824 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, num_et_id INT NOT NULL, code_mat_id INT NOT NULL, num_inscription VARCHAR(9) NOT NULL, note INT NOT NULL, INDEX IDX_11BA68CAD2E95BF (num_et_id), INDEX IDX_11BA68CA3219091 (code_mat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CAD2E95BF FOREIGN KEY (num_et_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CA3219091 FOREIGN KEY (code_mat_id) REFERENCES matiere (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE notes');
    }
}
