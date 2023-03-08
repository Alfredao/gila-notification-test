<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308003703 extends AbstractMigration
{
    public function getDescription()
    : string
    {
        return '';
    }

    public function up(Schema $schema)
    : void
    {
        $table = $schema->createTable('user_message');

        $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true]);
        $table->addColumn('user_id', 'integer', ['unsigned' => true]);
        $table->addColumn('message_id', 'integer', ['unsigned' => true]);
        $table->addColumn('created_at', 'datetime', ['notnull' => true]);
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);

        $table->setPrimaryKey(['id']);

        $table->addForeignKeyConstraint('user', ['user_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_user_message_user');
        $table->addForeignKeyConstraint('message', ['message_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_user_message_message');
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('user_message');
    }
}
