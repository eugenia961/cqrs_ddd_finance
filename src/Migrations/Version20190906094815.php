<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906094815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE countries (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, acronyms VARCHAR(10) NOT NULL, tax DOUBLE PRECISION DEFAULT NULL, currency VARCHAR(10) DEFAULT NULL, enable TINYINT(1) NOT NULL, color VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies (id VARCHAR(255) NOT NULL, country_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, ticker VARCHAR(10) NOT NULL, market VARCHAR(10) DEFAULT NULL, enable TINYINT(1) NOT NULL, INDEX IDX_8244AA3AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (company_id VARCHAR(255) NOT NULL, fifty_two_week_low DOUBLE PRECISION DEFAULT NULL, fifty_two_week_high DOUBLE PRECISION DEFAULT NULL, trailing_pe DOUBLE PRECISION DEFAULT NULL, trailing_annual_dividend_yield DOUBLE PRECISION DEFAULT NULL, regular_market_price DOUBLE PRECISION DEFAULT NULL, market VARCHAR(255) DEFAULT NULL, regular_market_time DATETIME DEFAULT NULL, PRIMARY KEY(company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE companies ADD CONSTRAINT FK_8244AA3AF92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE companies DROP FOREIGN KEY FK_8244AA3AF92F3E70');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C979B1AD6');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE statistic');
    }
}
