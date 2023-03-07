<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\ApiTools\Admin\Module as AdminModule;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;

use function class_exists;

/**
 * Class IndexController
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    : Response|ViewModel
    {
        if (class_exists(AdminModule::class, false)) {
            return $this->redirect()->toRoute('api-tools/ui');
        }

        return new ViewModel();
    }
}
