<?php

namespace PServerCMS\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

class Active extends AbstractHelper{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocatorInterface $serviceLocatorInterface
     */
    public function __construct(ServiceLocatorInterface $serviceLocatorInterface){
        $this->setServiceLocator($serviceLocatorInterface);
    }

    public function __invoke( $routekey, $params = array()){

        /** @var \Zend\Mvc\Router\Http\TreeRouteStack $router */
        $router = $this->serviceLocator->get('router');
        /** @var \Zend\Http\PhpEnvironment\Request $request */
        $request = $this->serviceLocator->get('request');

        foreach($params as $key => $param){
            if($router->match($request)->getParam($key) != $params[$key]){
                return false;
            }
        }
        
        $routeMatch = $router->match($request);
        if (!is_null($routeMatch)){
            if($routekey == $routeMatch->getMatchedRouteName()){
                return true;
            }
        }

        return false;
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator(){
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return $this
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}