<?php
declare(strict_types=1);

namespace Gila\Model\Factory;

use Core\Model\CurrencyModel;
use Core\Model\WalletModel;
use Doctrine\ORM\EntityManager;
use Gila\Model\PaymentModel;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PaymentModelFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Model\PaymentModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : PaymentModel
    {
        $model = new PaymentModel();
        $model->setEntityManager($container->get(EntityManager::class));
        $model->setWalletModel($container->get(WalletModel::class));
        $model->setCurrencyModel($container->get(CurrencyModel::class));

        return $model;
    }
}
