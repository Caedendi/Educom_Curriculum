<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122111059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE optreden (id INT AUTO_INCREMENT NOT NULL, poppodium_id INT NOT NULL, artiest_id INT NOT NULL, omschrijving VARCHAR(255) DEFAULT NULL, datum DATE NOT NULL, prijs NUMERIC(8, 2) NOT NULL, ticket_url VARCHAR(255) DEFAULT NULL, afbeelding_url VARCHAR(255) DEFAULT NULL, INDEX IDX_6286F65DA2EEBB18 (poppodium_id), INDEX IDX_6286F65DAED85528 (artiest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE optreden_artiest (optreden_id INT NOT NULL, artiest_id INT NOT NULL, INDEX IDX_378387D94418189F (optreden_id), INDEX IDX_378387D9AED85528 (artiest_id), PRIMARY KEY(optreden_id, artiest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DA2EEBB18 FOREIGN KEY (poppodium_id) REFERENCES poppodium (id)');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DAED85528 FOREIGN KEY (artiest_id) REFERENCES artiest (id)');
        $this->addSql('ALTER TABLE optreden_artiest ADD CONSTRAINT FK_378387D94418189F FOREIGN KEY (optreden_id) REFERENCES optreden (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE optreden_artiest ADD CONSTRAINT FK_378387D9AED85528 FOREIGN KEY (artiest_id) REFERENCES artiest (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE optreden_artiest DROP FOREIGN KEY FK_378387D94418189F');
        $this->addSql('DROP TABLE optreden');
        $this->addSql('DROP TABLE optreden_artiest');
    }
}
