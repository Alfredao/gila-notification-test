<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Repository\BroadcastRepo;

#[ORM\Table(name: 'broadcast')]
#[ORM\Entity(repositoryClass: BroadcastRepo::class)]
#[ORM\HasLifecycleCallbacks]
class Broadcast
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

    #[ORM\OneToMany(mappedBy: 'broadcast', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'subscriptions')]
    private Collection $subscribers;

    public function __construct()
    {
        $this->messages    = new ArrayCollection();
        $this->subscribers = new ArrayCollection();
    }

    /**
     * Get Id
     *
     * @return int|null
     */
    public function getId()
    : ?int
    {
        return $this->id;
    }

    /**
     * Get Category
     *
     * @return \Gila\Entity\Category|null
     */
    public function getCategory()
    : ?Category
    {
        return $this->category;
    }

    /**
     * Set Category
     *
     * @param \Gila\Entity\Category $category
     * @return Broadcast
     */
    public function setCategory(Category $category)
    : Broadcast
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get Channel
     *
     * @return \Gila\Entity\Channel|null
     */
    public function getChannel()
    : ?Channel
    {
        return $this->channel;
    }

    /**
     * Set Channel
     *
     * @param \Gila\Entity\Channel $channel
     * @return Broadcast
     */
    public function setChannel(Channel $channel)
    : Broadcast
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get Subscribers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscribers()
    : Collection
    {
        return $this->subscribers;
    }

    /**
     * Get Subscribers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    : Collection
    {
        return $this->messages;
    }
}
