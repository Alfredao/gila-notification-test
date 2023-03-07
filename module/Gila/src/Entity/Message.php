<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\Message\Status;
use Gila\Repository\MessageRepo;

#[ORM\Table(name: 'message')]
#[ORM\Entity(repositoryClass: MessageRepo::class)]
#[ORM\HasLifecycleCallbacks]
class Message
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(name: 'text', type: Types::STRING, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: 'delivered_at', type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $deliveredAt = null;

    #[ORM\Column(name: 'status', type: Types::INTEGER, nullable: false, enumType: Status::class)]
    private ?Status $status = null;

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
     * @return Message
     */
    public function setName(string $name)
    : Message
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get DeliveredAt
     *
     * @return \DateTimeImmutable|null
     */
    public function getDeliveredAt()
    : ?\DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    /**
     * Set DeliveredAt
     *
     * @param \DateTimeImmutable $deliveredAt
     * @return Message
     */
    public function setDeliveredAt(\DateTimeImmutable $deliveredAt)
    : Message
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\Message\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\Message\Status $status
     * @return Message
     */
    public function setStatus(Status $status)
    : Message
    {
        $this->status = $status;

        return $this;
    }
}
