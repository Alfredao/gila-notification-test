<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307061831 extends AbstractMigration
{
    public function getDescription()
    : string
    {
        return 'Create message table';
    }

    public function up(Schema $schema)
    : void
    {
        $table = $schema->createTable('message');

        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('category_id', 'integer', ['unsigned' => true, 'notnull' => true]);
        $table->addColumn('created_at', 'datetime', ['notnull' => true]);
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $table->addColumn('text', 'string', ['length' => 255, 'notnull' => true]);
        $table->addColumn('delivered_at', 'datetime', ['notnull' => false]);
        $table->addColumn('status', 'integer', ['notnull' => true, 'unsigned' => true]);

        $table->addForeignKeyConstraint('category', ['category_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_message_category');

        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('message');
    }
}
