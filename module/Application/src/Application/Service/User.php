<?php

namespace Support\Service;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Crypt\Password\Bcrypt;
//use Zend\Stdlib\Hydrator;
use ZfcBase\EventManager\EventProvider;
//use ZfcUser\Mapper\UserInterface as UserMapperInterface;
//use ZfcUser\Options\UserServiceOptionsInterface;


class User extends EventProvider implements ServiceManagerAwareInterface {

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var UserServiceOptionsInterface
     */
    protected $options;

    /**
     * getAuthService
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        if (null === $this->authService) {
            $this->authService = $this->getServiceManager()->get('user_auth_service');
        }
        return $this->authService;
    }

    /**
     * setAuthenticationService
     *
     * @param AuthenticationService $authService
     * @return User
     */
    public function setAuthService(AuthenticationService $authService) {
        $this->authService = $authService;
        return $this;
    }

    /**
     * get service options
     *
     * @return UserServiceOptionsInterface
     */
    public function getOptions(){
		if (!$this->options instanceof UserServiceOptionsInterface) {
            $this->setOptions($this->getServiceManager()->get('user_module_options'));
		}
        return $this->options;
    }

    /**
     * set service options
     *
     * @param UserServiceOptionsInterface $options
	 */
    public function setOptions(UserServiceOptionsInterface $options) {
        $this->options = $options;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * getMapper
     *
     * @return UserMapperInterface
     */
    public function getMapper() {
        if (null === $this->mapper) {
            $this->mapper = $this->getServiceLocator()->get('user_user_mapper');
        }
        return $this->mapper;
    }
}
