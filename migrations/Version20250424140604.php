<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424140604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE design_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE estimate_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE event_picture_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE invoice_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE address (id INT NOT NULL, number VARCHAR(4) NOT NULL, path VARCHAR(255) NOT NULL, postal_code VARCHAR(6) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INT NOT NULL, address_id INT NOT NULL, name VARCHAR(50) NOT NULL, first_name_contact VARCHAR(50) NOT NULL, last_name_contact VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C7440455F5B7AF75 ON client (address_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE contact (id INT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, society VARCHAR(100) DEFAULT NULL, message TEXT NOT NULL, status BOOLEAN NOT NULL, phone_number VARCHAR(10) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE design (id INT NOT NULL, name VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE design_tag (design_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(design_id, tag_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4DD61079E41DC9B2 ON design_tag (design_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4DD61079BAD26311 ON design_tag (tag_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE estimate (id INT NOT NULL, client_id INT NOT NULL, address_id INT NOT NULL, event_id INT DEFAULT NULL, number VARCHAR(25) NOT NULL, emission_date DATE NOT NULL, validate_date DATE NOT NULL, event_date DATE NOT NULL, start_time TIME(0) WITHOUT TIME ZONE NOT NULL, end_time TIME(0) WITHOUT TIME ZONE NOT NULL, price NUMERIC(6, 2) NOT NULL, defrayal NUMERIC(6, 2) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D2EA460719EB6921 ON estimate (client_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D2EA4607F5B7AF75 ON estimate (address_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_D2EA460771F7E88B ON estimate (event_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN estimate.emission_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN estimate.validate_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN estimate.event_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN estimate.start_time IS '(DC2Type:time_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN estimate.end_time IS '(DC2Type:time_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE event (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE event_picture (id INT NOT NULL, event_id INT NOT NULL, alt VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_938CE62671F7E88B ON event_picture (event_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE invoice (id INT NOT NULL, estimate_id INT NOT NULL, number VARCHAR(255) NOT NULL, emission_date DATE NOT NULL, event_date DATE NOT NULL, start_time TIME(0) WITHOUT TIME ZONE NOT NULL, end_time TIME(0) WITHOUT TIME ZONE NOT NULL, price NUMERIC(6, 2) NOT NULL, defrayal NUMERIC(6, 2) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_9065174485F23082 ON invoice (estimate_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.emission_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.event_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.start_time IS '(DC2Type:time_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.end_time IS '(DC2Type:time_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client ADD CONSTRAINT FK_C7440455F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE design_tag ADD CONSTRAINT FK_4DD61079E41DC9B2 FOREIGN KEY (design_id) REFERENCES design (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE design_tag ADD CONSTRAINT FK_4DD61079BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estimate ADD CONSTRAINT FK_D2EA460719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estimate ADD CONSTRAINT FK_D2EA4607F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estimate ADD CONSTRAINT FK_D2EA460771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_picture ADD CONSTRAINT FK_938CE62671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice ADD CONSTRAINT FK_9065174485F23082 FOREIGN KEY (estimate_id) REFERENCES estimate (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE address_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE client_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE contact_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE design_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE estimate_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE event_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE event_picture_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE invoice_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE tag_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client DROP CONSTRAINT FK_C7440455F5B7AF75
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE design_tag DROP CONSTRAINT FK_4DD61079E41DC9B2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE design_tag DROP CONSTRAINT FK_4DD61079BAD26311
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estimate DROP CONSTRAINT FK_D2EA460719EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estimate DROP CONSTRAINT FK_D2EA4607F5B7AF75
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estimate DROP CONSTRAINT FK_D2EA460771F7E88B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_picture DROP CONSTRAINT FK_938CE62671F7E88B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice DROP CONSTRAINT FK_9065174485F23082
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE address
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contact
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE design
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE design_tag
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE estimate
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event_picture
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE invoice
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
