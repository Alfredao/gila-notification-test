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

        $table->addColumn('user_id', 'integer', ['unsigned' => true]);
        $table->addColumn('broadcast_id', 'integer', ['unsigned' => true]);
        $table->addColumn('created_at', 'datetime', ['notnull' => true]);
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);

        $table->setPrimaryKey(['user_id', 'broadcast_id']);

        $table->addForeignKeyConstraint('user', ['user_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_subscription_user');
        $table->addForeignKeyConstraint('broadcast', ['broadcast_id'], ['id'], ['onDelete' => 'CASCADE'], 'fk_subscription_broadcast');
    }

    public function down(Schema $schema)
    : void
    {
        $schema->dropTable('subscription');
    }
}
