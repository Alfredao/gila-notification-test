<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Repository\SubscriptionRepo;

#[ORM\Table(name: 'subscription')]
#[ORM\Entity(repositoryClass: SubscriptionRepo::class)]
#[ORM\HasLifecycleCallbacks]
class Subscription
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'subscriptions')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Channel::class)]
    #[ORM\JoinColumn(name: 'channel_id', referencedColumnName: 'id')]
    private ?Channel $channel = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private ?Category $category = null;

    public function getArrayCopy()
    : array
    {
        return [
            'id'       => $this->getId(),
            'category' => $this->getCategory()?->getArrayCopy(),
            'channel'  => $this->getChannel()?->getArrayCopy(),
        ];
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
     * Get User
     *
     * @return \Gila\Entity\User|null
     */
    public function getUser()
    : ?User
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param \Gila\Entity\User $user
     * @return Subscription
     */
    public function setUser(User $user)
    : Subscription
    {
        $this->user = $user;

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
     * @return Subscription
     */
    public function setChannel(Channel $channel)
    : Subscription
    {
        $this->channel = $channel;

        return $this;
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
     * @return Subscription
     */
    public function setCategory(Category $category)
    : Subscription
    {
        $this->category = $category;

        return $this;
    }
}
