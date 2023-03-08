<?php
declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Gila\Entity\Channel;
use Gila\Entity\Category;
use Gila\Entity\User;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308211821 extends AbstractMigration
{
    public function getDescription()
    : string
    {
        return 'Populate DB';
    }

    public function up(Schema $schema)
    : void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema)
    : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }


    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws \Exception
     */
    public function postUp(Schema $schema)
    : void
    {
        /** INSERT CHANNELS */
        $this->connection->insert('channel', [
            'name'       => 'SMS',
            'status'     => Channel\Status::ACTIVE->value,
            'type'       => Channel\Type::SMS->value,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->connection->insert('channel', [
            'name'       => 'E-mail',
            'status'     => Channel\Status::ACTIVE->value,
            'type'       => Channel\Type::EMAIL->value,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->connection->insert('channel', [
            'name'   => 'Push Notification',
            'status' => Channel\Status::ACTIVE->value,
            'type'   => Channel\Type::PUSH->value,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        /** INSERT CATEGORIES */
        $this->connection->insert('category', [
            'name'   => 'Finance',
            'status' => Category\Status::ACTIVE->value,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->connection->insert('category', [
            'name'   => 'Sports',
            'status' => Category\Status::ACTIVE->value,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->connection->insert('category', [
            'name'   => 'Movies',
            'status' => Category\Status::ACTIVE->value,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        /** INSERT USERS */

        $users = [
            [
                'name'         => 'Alfredo Costa',
                'email'        => 'alfredocosta@live.com',
                'phone_number' => '+5531984527446',
                'status'       => User\Status::ACTIVE->value,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'John Doe',
                'email'        => 'johndoe@example.com',
                'phone_number' => '+17252534579',
                'status'       => User\Status::ACTIVE->value,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Billy Jean',
                'email'        => 'billy.jean@live.com',
                'phone_number' => '+17352541252',
                'status'       => User\Status::ACTIVE->value,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Mary Jane',
                'email'        => 'mary.jane@gmail.com',
                'phone_number' => '+5531985606267',
                'status'       => User\Status::ACTIVE->value,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Neymar Junior',
                'email'        => 'neymarjr@psg.com',
                'phone_number' => '+5511983740384',
                'status'       => User\Status::ACTIVE->value,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $user) {
            $this->connection->insert('user', $user);

            $userId = $this->connection->lastInsertId();

            $this->connection->insert('subscription', [
                'user_id'     => $userId,
                'category_id' => random_int(1, 3),
                'channel_id'  => random_int(1, 3),
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $this->connection->insert('subscription', [
                'user_id'     => $userId,
                'category_id' => random_int(1, 3),
                'channel_id'  => random_int(1, 3),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }


    public function postDown(Schema $schema)
    : void
    {
    }
}
