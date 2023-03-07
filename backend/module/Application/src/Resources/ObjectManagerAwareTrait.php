<?php

namespace Application\Resources;

use Doctrine\Persistence\ObjectManager;

/**
 * Trait ObjectManagerAwareTrait
 *
 * @package Application\Traits
 */
trait ObjectManagerAwareTrait
{
    private ObjectManager $objectManager;

    /**
     * Get the object manager
     */
    public function getObjectManager()
    : ObjectManager
    {
        return $this->objectManager;
    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    : void
    {
        $this->objectManager = $objectManager;
    }
}
