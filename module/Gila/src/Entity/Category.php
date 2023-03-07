<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\Category\Status;
use Gila\Repository\CategoryRepo;

#[ORM\Table(name: 'category')]
#[ORM\Entity(repositoryClass: CategoryRepo::class)]
#[ORM\HasLifecycleCallbacks]
class Category
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: Types::STRING, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: 'status', type: Types::INTEGER, nullable: false, enumType: Status::class)]
    private ?Status $status = null;

    #[ORM\ManyToMany(targetEntity: Channel::class, inversedBy: 'categories')]
    #[ORM\JoinTable(name: 'category_channel')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'channel_id', referencedColumnName: 'id')]
    private Collection $channels;
}
