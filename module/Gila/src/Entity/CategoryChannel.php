<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Repository\CategoryChannelRepo;

#[ORM\Table(name: 'category_channel')]
#[ORM\Entity(repositoryClass: CategoryChannelRepo::class)]
#[ORM\HasLifecycleCallbacks]
class CategoryChannel
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'channels')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity: Channel::class, inversedBy: 'channels')]
    #[ORM\JoinColumn(name: 'channel_id', referencedColumnName: 'id')]
    private ?Channel $channel = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'subscriptions')]
    private Collection $users;
}
