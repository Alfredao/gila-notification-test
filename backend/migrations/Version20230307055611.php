<?php
declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307055611 extends AbstractMigration
{
    public function getDescription()
    : string
    {
        return 'Create channel and category tables';
    }

    public function up(Schema $schema)
    : void
    {
        // Create channel table
        $channelTable = $schema->createTable('channel');

        $channelTable->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true]);
        $channelTable->addColumn('created_at', 'datetime', ['notnull' => true]);
        $channelTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $channelTable->addColumn('name', 'string', ['length' => 255, 'notnull' => true]);
        $channelTable->addColumn('status', 'integer', ['notnull' => true]);

        $channelTable->setPrimaryKey(['id']);
        $channelTable->addUniqueIndex(['name']);


        // Create category table
        $categoryTable = $schema->createTable('category');

        $categoryTable->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true]);
        $categoryTable->addColumn('created_at', 'datetime', ['notnull' => true]);
        $categoryTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $categoryTable->addColumn('name', 'string', ['length' => 255, 'notnull' => true]);
        $categoryTable->addColumn('status', 'integer', ['notnull' => true, 'unsigned' => true]);

        $categoryTable->setPrimaryKey(['id']);
        $categoryTable->addUniqueIndex(['name']);


        // Create broadcast table
        $categoryChannelTable = $schema->createTable('broadcast');

        $categoryChannelTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $categoryChannelTable->addColumn('category_id', 'integer', ['unsigned' => true, 'notnull' => true]);
        $categoryChannelTable->addColumn('channel_id', 'integer', ['unsigned' => true, 'notnull' => true]);
        $categoryChannelTable->addColumn('created_at', 'datetime', ['notnull' => true]);
        $categoryChannelTable->addColumn('updated_at', 'datetime', ['notnull' => false]);

        $categoryChannelTable->addForeignKeyConstraint('category', ['category_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_broadcast_category');
        $categoryChannelTable->addForeignKeyConstraint('channel', ['channel_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_broadcast_channel');

        $categoryChannelTable->setPrimaryKey(['id']);
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('broadcast');
        $schema->dropTable('category');
        $schema->dropTable('channel');
    }
}
