<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180703090917 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE psychologist (id INT AUTO_INCREMENT NOT NULL, specialization_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(500) NOT NULL, gender TINYINT(1) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_FFC468E0FA846217 (specialization_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, appointment_id INT DEFAULT NULL, monitoring_id INT DEFAULT NULL, grade INT NOT NULL, comment VARCHAR(2000) DEFAULT NULL, INDEX IDX_FE38F844E5B533F9 (appointment_id), UNIQUE INDEX UNIQ_FE38F844DA4638B5 (monitoring_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_monitoring (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_1D2851B1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hint (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(2000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, description VARCHAR(1500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE psychologist ADD CONSTRAINT FK_FFC468E0FA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844E5B533F9 FOREIGN KEY (appointment_id) REFERENCES psychologist (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844DA4638B5 FOREIGN KEY (monitoring_id) REFERENCES user_monitoring (id)');
        $this->addSql('ALTER TABLE user_monitoring ADD CONSTRAINT FK_1D2851B1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844E5B533F9');
        $this->addSql('ALTER TABLE user_monitoring DROP FOREIGN KEY FK_1D2851B1A76ED395');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844DA4638B5');
        $this->addSql('ALTER TABLE psychologist DROP FOREIGN KEY FK_FFC468E0FA846217');
        $this->addSql('DROP TABLE psychologist');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_monitoring');
        $this->addSql('DROP TABLE hint');
        $this->addSql('DROP TABLE specialization');
    }
}
