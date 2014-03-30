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
        $this->addSql('CREATE TABLE `user` (`user_id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,`username` VARCHAR(255) DEFAULT NULL UNIQUE, `email` VARCHAR(255) DEFAULT NULL UNIQUE, `display_name` VARCHAR(50) DEFAULT NULL, `password` VARCHAR(128) NOT NULL, `state` SMALLINT ) ENGINE=InnoDB;');
        
        //Add album table for functionality
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, artist VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
