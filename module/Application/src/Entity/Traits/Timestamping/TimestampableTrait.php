<?php

declare(strict_types=1);

namespace Application\Entity\Traits\Timestamping;

/**
 * This trait adds timestamp-able (created at and updated at) fields to entity.
 */
trait TimestampableTrait
{
    use AutoCreatedAtTrait;
    use AutoUpdatedAtTrait;
}
