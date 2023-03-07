<?php
declare(strict_types=1);

namespace ApplicationTest\Controller;

use Dotenv\Dotenv;
use function getcwd;

class AbstractHttpControllerTestCase extends \Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase
{

    /**
     * Set up test. This method is called before each test
     *
     * @return void
     */
    protected function setUp()
    : void
    {
        $dotenv = Dotenv::createImmutable(getcwd());
        $dotenv->load();

        parent::setUp();
    }
}
