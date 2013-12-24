<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $rute = new Application_Form_Pretraga();
        $this->view->forma = $rute;
    }

    public function naruciAction()
    {
        
    }

    public function izlazneAction()
    {   
 
    }


}





