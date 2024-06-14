<?php

declare(strict_types=1);

namespace App\Employee\Infrastructure\Persistence\Doctrine\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240614090552 extends AbstractMigration
{
    #[\Override]
    public function getDescription(): string
    {
        return 'create employee tables';
    }

    #[\Override]
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE employee (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', employee_id INT NOT NULL, user_name VARCHAR(255) NOT NULL, name_prefix VARCHAR(5) NOT NULL, first_name VARCHAR(255) NOT NULL, middle_initial VARCHAR(1) NOT NULL, last_name VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, email VARCHAR(255) NOT NULL, date_and_time_of_birth DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_of_joining DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', phone_no VARCHAR(255) NOT NULL, place_name VARCHAR(255) NOT NULL, county VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5D9F75A18C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    #[\Override]
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE employee');
    }
}
