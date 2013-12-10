<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $rute = new Application_Form_Pretraga();
        $this->view->forma = $rute;
    }

    public function naruciAction()
    {
        
    }


}



