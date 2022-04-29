<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428073304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bilan_objet (id INT AUTO_INCREMENT NOT NULL, id_don_objet_id INT DEFAULT NULL, id_sortie_id INT NOT NULL, INDEX IDX_4E65558542AB2CC3 (id_don_objet_id), INDEX IDX_4E6555854C476574 (id_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bilan_objet ADD CONSTRAINT FK_4E65558542AB2CC3 FOREIGN KEY (id_don_objet_id) REFERENCES don_objet (id)');
        $this->addSql('ALTER TABLE bilan_objet ADD CONSTRAINT FK_4E6555854C476574 FOREIGN KEY (id_sortie_id) REFERENCES sortie_objet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bilan_objet');
    }
}
