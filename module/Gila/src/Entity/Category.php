<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
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

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Broadcast::class)]
    private Collection $broadcasts;

    public function __construct()
    {
        $this->broadcasts = new ArrayCollection();
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
     * @return Category
     */
    public function setName(string $name)
    : Category
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\Category\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\Category\Status $status
     * @return Category
     */
    public function setStatus(Status $status)
    : Category
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get Broadcasts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBroadcasts()
    : Collection
    {
        return $this->broadcasts;
    }
}
