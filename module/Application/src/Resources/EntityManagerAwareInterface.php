<?php

declare(strict_types=1);

namespace Application\Resources;

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
    : ?\Doctrine\ORM\EntityManager;

    /**
     * Set entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return static
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    : static;
}
