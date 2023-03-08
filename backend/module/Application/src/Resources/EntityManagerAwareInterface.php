<?php

declare(strict_types=1);

namespace Application\Resources;

use Doctrine\ORM\EntityManager;

/**
 * Interface EntityManagerAwareInterface
 *
 * @package Application\Resources
 */
interface EntityManagerAwareInterface
{

    /**
     * Get entity manager
     *
     * @return ?\Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    : ?EntityManager;

    /**
     * Set entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return static
     */
    public function setEntityManager(EntityManager $entityManager)
    : static;
}
