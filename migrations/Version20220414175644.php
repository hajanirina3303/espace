<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414175644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece ADD numero_piece INT NOT NULL, CHANGE idPiece idPiece INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (idPiece)');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EC050E4AE FOREIGN KEY (rubrique_ref) REFERENCES rubrique (RefRubrique)');
        
        $this->addSql('ALTER TABLE releve ADD file VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EC40FCFA8');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EC050E4AE');
        $this->addSql('ALTER TABLE piece DROP numero_piece, CHANGE idPiece idPiece INT NOT NULL');
        $this->addSql('ALTER TABLE releve DROP file');
    }
}
