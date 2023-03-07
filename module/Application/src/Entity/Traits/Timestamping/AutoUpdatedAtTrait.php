<?php

declare(strict_types=1);

namespace Application\Entity\Traits\Timestamping;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * This trait adds updatedAt field to entity.
 */
trait AutoUpdatedAtTrait
{
    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    protected ?DateTimeInterface $updatedAt = null;

    public function getUpdatedAt()
    : ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt()
    : self
    {
        $this->updatedAt = new DateTime();

        return $this;
    }
}
