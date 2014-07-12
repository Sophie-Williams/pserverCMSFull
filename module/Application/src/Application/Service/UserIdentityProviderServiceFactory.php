<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Support\Service;

use Support\Provider\Identity\UserDb as UserData;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory responsible of instantiating {@see \BjyAuthorize\Provider\Identity\ZfcUserZendDb}
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
class UserIdentityProviderServiceFactory implements FactoryInterface {
    /**
     * {@inheritDoc}
     *
     * @return \BjyAuthorize\Provider\Identity\ZfcUserZendDb
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /* @var $adapter \Zend\Db\Adapter\Adapter */
        $adapter     = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        /* @var $userService \ZfcUser\Service\User */
        $userService = $serviceLocator->get('user_user_service');
        $config      = $serviceLocator->get('BjyAuthorize\Config');

        $provider = new UserData($adapter, $userService);

        $provider->setDefaultRole($config['default_role']);

        return $provider;
    }
}
