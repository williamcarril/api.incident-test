<?php

declare(strict_types=1);

namespace DoctrineMigration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190316210214 extends AbstractMigration {

    public function getDescription() : string {
        return 'Bootstrap all database tables.';
    }

    public function up(Schema $schema) : void {

        $this->addSql("
            CREATE TABLE tb_criticity (
                
                  id    INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY
                , slug  VARCHAR(10) NOT NULL
                , name  VARCHAR(15) NOT NULL
                , CONSTRAINT uq_criticity_slug UNIQUE(slug)

            ) ENGINE=InnoDB
        ");

        $this->addSql("
            INSERT INTO tb_criticity (
                  slug
                , name
            ) 
            VALUES 
                  ('high', 'Alta')
                , ('medium', 'Média')
                , ('low', 'Baixa')
        ");

        $this->addSql("
            CREATE TABLE tb_type (
                
                  id    INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY
                , slug  VARCHAR(30) NOT NULL
                , name  VARCHAR(50) NOT NULL
                , CONSTRAINT uq_type_slug UNIQUE(slug)

            ) ENGINE=InnoDB
        ");

        $this->addSql("
            INSERT INTO tb_type (
                  slug
                , name
            ) 
            VALUES 
                  ('brute-force-attack', 'Ataque Brute Force')
                , ('login-data-leak', 'Credenciais vazadas')
                , ('ddos-attack', 'Ataque de DDoS')
                , ('abnormal-user-activity', 'Atividades anormais de usuários')
        ");

        $this->addSql("
            CREATE TABLE tb_status (
                
                  id    INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY
                , slug  VARCHAR(10) NOT NULL
                , name  VARCHAR(15) NOT NULL
                , CONSTRAINT uq_status_slug UNIQUE(slug)

            ) ENGINE=InnoDB
        ");

        $this->addSql("
            INSERT INTO tb_status (
                  slug
                , name
            ) 
            VALUES 
                  ('open', 'Aberto')
                , ('closed', 'Fechado')
        ");

        $this->addSql("
            CREATE TABLE tb_incident (
                
                  id    INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY
                , title VARCHAR(50) NOT NULL
                , description TEXT NOT NULL

                , criticity_id INT UNSIGNED NULL
                , type_id INT UNSIGNED NOT NULL
                , status_id INT UNSIGNED NOT NULL

                , CONSTRAINT fk_incident_criticity 
                    FOREIGN KEY (criticity_id) 
                    REFERENCES tb_criticity (id)

                , CONSTRAINT fk_incident_type 
                    FOREIGN KEY (type_id) 
                    REFERENCES tb_type (id)
                    
                , CONSTRAINT fk_incident_status 
                    FOREIGN KEY (status_id) 
                    REFERENCES tb_status (id)

            ) ENGINE=InnoDB
        ");
    }

    public function down(Schema $schema) : void {
        $this->addSql("DROP TABLE tb_incident");
        $this->addSql("DROP TABLE tb_status");
        $this->addSql("DROP TABLE tb_type");
        $this->addSql("DROP TABLE tb_criticity");
    }
}
