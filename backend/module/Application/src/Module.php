<?php
declare(strict_types=1);

namespace Application;

class Module
{
    /**
     * @return array<string,mixed>
     */
    public function getConfig()
    : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
