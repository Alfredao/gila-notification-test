<?php
declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307055244 extends AbstractMigration
{
    public function getDescription()
    : string
    {
        return 'Create user table';
    }

    public function up(Schema $schema)
    : void
    {
        $table = $schema->createTable('user');
        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('name', 'string', ['notnull' => true]);
        $table->addColumn('email', 'string', ['notnull' => true]);
        $table->addColumn('phone_number', 'string', ['notnull' => true]);
        $table->addColumn('status', 'integer', ['notnull' => true]);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('user');
    }
}
