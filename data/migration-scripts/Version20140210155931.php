<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140210155931 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        //Add user table for security
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, state INT NOT NULL, gender INT NOT NULL, phone_number INT NOT NULL, address INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        
        //Add album table for functionality
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, artist VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
