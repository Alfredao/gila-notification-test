<?php
declare(strict_types=1);

namespace Application\Resources;

use Doctrine\ORM\EntityManager;

/**
 * Trait EntityManagerAwareTrait
 *
 * @package Application\Traits
 */
trait EntityManagerAwareTrait
{
    private EntityManager $entityManager;

    /**
     * Get entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    : EntityManager
    {
        return $this->entityManager;
    }

    /**
     * Set entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return static
     */
    public function setEntityManager(EntityManager $entityManager)
    : static
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
