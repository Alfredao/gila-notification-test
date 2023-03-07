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
    private Collection $subscribers;

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
     * @return CategoryChannel
     */
    public function setCategory(Category $category)
    : CategoryChannel
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
     * @return CategoryChannel
     */
    public function setChannel(Channel $channel)
    : CategoryChannel
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
}
