<?php

namespace Application\Resources;

use Admin\Entity\Parametro;

/**
 * Trait ParametroAwareTrait
 *
 * @package Application\Traits
 */
trait ParametroAwareTrait
{

    private ?Parametro $parametros = null;

    /**
     * Get parametro
     *
     * @return Parametro
     */
    public function getParametros()
    : ?Parametro
    {
        return $this->parametros;
    }

    /**
     * Set parametro
     *
     * @param Parametro $parametros
     */
    public function setParametros(Parametro $parametros)
    {
        $this->parametros = $parametros;
    }
}
