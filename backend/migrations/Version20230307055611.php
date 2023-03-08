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
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('category');
        $schema->dropTable('channel');
    }
}
