<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402185047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diagnosis (id INT AUTO_INCREMENT NOT NULL, paciente_id INT DEFAULT NULL, datedia DATE NOT NULL, INDEX IDX_7ED10F3D7310DAD4 (paciente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diagnosis_pathology (diagnosis_id INT NOT NULL, pathology_id INT NOT NULL, INDEX IDX_A5DFA4233CBE4D00 (diagnosis_id), INDEX IDX_A5DFA423CE86795D (pathology_id), PRIMARY KEY(diagnosis_id, pathology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paciente (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pathology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diagnosis ADD CONSTRAINT FK_7ED10F3D7310DAD4 FOREIGN KEY (paciente_id) REFERENCES paciente (id)');
        $this->addSql('ALTER TABLE diagnosis_pathology ADD CONSTRAINT FK_A5DFA4233CBE4D00 FOREIGN KEY (diagnosis_id) REFERENCES diagnosis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diagnosis_pathology ADD CONSTRAINT FK_A5DFA423CE86795D FOREIGN KEY (pathology_id) REFERENCES pathology (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diagnosis DROP FOREIGN KEY FK_7ED10F3D7310DAD4');
        $this->addSql('ALTER TABLE diagnosis_pathology DROP FOREIGN KEY FK_A5DFA4233CBE4D00');
        $this->addSql('ALTER TABLE diagnosis_pathology DROP FOREIGN KEY FK_A5DFA423CE86795D');
        $this->addSql('DROP TABLE diagnosis');
        $this->addSql('DROP TABLE diagnosis_pathology');
        $this->addSql('DROP TABLE paciente');
        $this->addSql('DROP TABLE pathology');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
