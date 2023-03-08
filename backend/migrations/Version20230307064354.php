<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307064354 extends AbstractMigration
{
    public function getDescription()
    : string
    {
        return 'Create subscription table';
    }

    public function up(Schema $schema)
    : void
    {
        $table = $schema->createTable('subscription');

        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('user_id', 'integer', ['unsigned' => true]);
        $table->addColumn('category_id', 'integer', ['unsigned' => true]);
        $table->addColumn('channel_id', 'integer', ['unsigned' => true]);
        $table->addColumn('created_at', 'datetime', ['notnull' => true]);
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);

        $table->setPrimaryKey(['id']);

        $table->addForeignKeyConstraint('user', ['user_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_subscription_user');
        $table->addForeignKeyConstraint('category', ['category_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_subscription_category');
        $table->addForeignKeyConstraint('channel', ['channel_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_subscription_channel');
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('subscription');
    }
}
