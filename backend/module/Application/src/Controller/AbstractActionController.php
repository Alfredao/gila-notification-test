<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Http\Request;
use Laminas\Stdlib\ParametersInterface;

class AbstractActionController extends \Laminas\Mvc\Controller\AbstractActionController
{
    /**
     * Is POST request?
     */
    protected function isPost(): bool
    {
        return Request::METHOD_POST === $this->getRequest()->getMethod();
    }

    /**
     * Get post data
     */
    protected function getPost(): ParametersInterface
    {
        return $this->getRequest()->getPost();
    }

    /**
     * Get posted files
     */
    protected function getFiles(): ParametersInterface
    {
        return $this->getRequest()->getFiles();
    }
}
