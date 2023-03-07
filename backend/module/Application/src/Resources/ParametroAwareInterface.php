<?php

namespace Application\Resources;

use Admin\Entity\Parametro;

/**
 * Trait ParametroAwareInterface
 *
 * @package Application\Resources
 */
interface ParametroAwareInterface
{

    /**
     * Get parametro
     *
     * @return Parametro
     */
    public function getParametros()
    : ?Parametro;

    /**
     * Set parametro
     *
     * @param Parametro $parametro
     */
    public function setParametros(Parametro $parametro);
}
