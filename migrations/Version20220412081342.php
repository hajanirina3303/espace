<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412081342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C388FA4097C FOREIGN KEY (rubrique) REFERENCES rubrique (RefRubrique)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C387B3C9061 FOREIGN KEY (don_id) REFERENCES don_objet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C388FA4097C');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C387B3C9061');
    }
}
