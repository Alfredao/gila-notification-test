<?php
declare(strict_types=1);

namespace Application\Entity\Traits\Timestamping;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * This trait adds createdAt field to entity.
 */
trait AutoCreatedAtTrait
{
    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE, nullable: false)]
    protected ?DateTimeInterface $createdAt = null;

    public function getCreatedAt()
    : ?DateTimeInterface
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt()
    : self
    {
        $this->createdAt = new DateTimeImmutable();

        return $this;
    }
}
