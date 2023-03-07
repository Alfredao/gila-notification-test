<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\User\Status;
use Gila\Repository\ChannelRepo;

#[ORM\Table(name: 'channel')]
#[ORM\Entity(repositoryClass: ChannelRepo::class)]
#[ORM\HasLifecycleCallbacks]
class Channel
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

    #[ORM\OneToMany(mappedBy: 'channel', targetEntity: CategoryChannel::class)]
    private Collection $categoryChannels;

    public function __construct()
    {
        $this->categoryChannels = new ArrayCollection();
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
     * Get Name
     *
     * @return string|null
     */
    public function getName()
    : ?string
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return Channel
     */
    public function setName(string $name)
    : Channel
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\User\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\User\Status $status
     * @return Channel
     */
    public function setStatus(Status $status)
    : Channel
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get Categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryChannels()
    : Collection
    {
        return $this->categoryChannels;
    }
}
