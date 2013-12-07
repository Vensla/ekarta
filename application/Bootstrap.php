<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initRoutes() {
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();
        
        $routePocetna = new Zend_Controller_Router_Route_Static('naslovna', array('controller' => 'Index', 'action' => 'index'));
        $router->addRoute('naslovna', $routePocetna);
    }

}

