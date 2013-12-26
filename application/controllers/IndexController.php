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
        $request=$this->getRequest();
        if($request->isXmlHttpRequest()){
            $izlazneStanice = array();
            $this->_helper->layout()->disableLayout(); 
            $this->_helper->viewRenderer->setNoRender(true);
            $id=$request->getParam('usid');
            $result=null;
            if(!empty($id) && $id != 0){
                $staniceM = new Application_Model_Soap(); 
                $result = $staniceM->getUlazneStanice();
                foreach ($result as $stanica){
                    $izlazneStanice[$stanica->_idStanica] = $stanica->_naziv;
                }
            }
            print Zend_Json::encode($izlazneStanice,  Zend_Json::TYPE_OBJECT);
        }
    }


}





