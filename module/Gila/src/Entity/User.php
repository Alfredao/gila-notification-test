<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\User\Status;
use Gila\Repository\UserRepo;

#[ORM\Table(name: 'user')]
#[ORM\Entity(repositoryClass: UserRepo::class)]
#[ORM\HasLifecycleCallbacks]
class User
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: Types::STRING, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: 'email', type: Types::STRING, nullable: false)]
    private ?string $email = null;

    #[ORM\Column(name: 'phone_number', type: Types::STRING, nullable: false)]
    private ?string $phoneNumber = null;

    #[ORM\Column(name: 'status', type: Types::INTEGER, nullable: false, enumType: Status::class)]
    private ?Status $status = null;
}
