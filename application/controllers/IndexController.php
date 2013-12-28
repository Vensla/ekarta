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
        $request=$this->getRequest();
        $naruci = new Application_Form_Naruci();
        $this->view->forma = $naruci;
        $model = new Application_Model_Soap(); 
        $id = $request->getParam('redVoznje');
        $result = $model->getRedVoznje($id);
        $this->view->rezultat = $result;
        $this->view->datum = $request->getParam('datum');
        $datum = $request->getParam('datum');
        $datum = explode(" ", $datum);
        $d = $datum[1];
        $date = date_parse_from_format('d.m.Y', $d);
        $vremePolaska = mktime(0, 0, 0, $date['month'], $date['day'], $date['year']);
        if ($request->isPost() && $naruci->isValid($request->getPost()) && $naruci->getValue('ddlPovratna') != 5) {
            $data = array(
                //'idKarta' => $idKarte,
                'idTrasa' => $request->getParam("trasa"),
                'idPopust' => $naruci->getValue('ddlPopust'),
                'idStanicaPolaska' => $request->getParam("usid"),
                'idStanicaDolaska' => $request->getParam("isid"),
                'vremePolaska' => $vremePolaska,
                'cena' => 500,
                'aktivnost' => 1,
                'povratna' => $naruci->getValue('ddlPovratna')
            );
            $karta = $model->napraviObjKarte();
            $karta = (object) $data;
            $poruka = $model->napraviKartu($karta);
            $this->view->poruka = "Uspešno ste naručili kartu. Id Vaše karte je: ".$poruka.". <a href='/Index/stampa/karta/".$poruka."'>Štampa</a>";
            $naruci->reset();
        }
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
                $result = $staniceM->getIzlazneStanice($id);
                foreach ($result as $stanica){
                    $izlazneStanice[$stanica->_idStanica] = $stanica->_naziv;
                }
            }
            print Zend_Json::encode($izlazneStanice,  Zend_Json::TYPE_OBJECT);
        }
    }

    public function listaAction()
    {
        $request=$this->getRequest();
        if($request->isXmlHttpRequest()){
            $lista = array();
            $this->_helper->layout()->disableLayout(); 
            $this->_helper->viewRenderer->setNoRender(true);
            $idU=$request->getParam('usid');
            $idI=$request->getParam('isid');
            $datum=$request->getParam('d');
            $dan = explode(' ', $datum);
            $d = "";
             if($dan[0] == "(Mon)" || $dan[0] == "(Tue)" || $dan[0] == "(Wed)" || $dan[0] == "(Thu)" || $dan[0] == "(Fri)"){
                $d = 1;
            }else if($dan[0] == "(Sat)"){
                $d = 2;
            }else if($dan[0] == "(Sun)"){
                $d = 3;
            }
            $result=null;
            if(!empty($idU) && $idU != 0 && !empty($idI) && !empty($datum)){
                $model = new Application_Model_Soap(); 
                $result = $model->getRuta($idU, $idI, $d);
                foreach ($result as $r) {
                    $lista[$r->_idRedVoznje] = $r->_idTrasa." ".$r->_dan." ".$r->_vremePolaska;
                }
                print Zend_Json::encode($lista,  Zend_Json::TYPE_OBJECT);
            }else{
                print Zend_Json::encode($lista[] = "Popunite sve podatke!",  Zend_Json::TYPE_OBJECT);
            }
        }
    }

    public function stampaAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $request=$this->getRequest();
        $this->view->id = $request->getParam('karta');
        $model = new Application_Model_Soap(); 
        $id = (int)$request->getParam('karta');
        $result = $model->nadjiKartu($id);
        print_r($result);
        if($result->_povratna == 1){
            $povratna = "Da";
        }else{
            $povratna = "Ne";
        }
        echo "<table style='padding:20px;'><tr><td>Ulazna stanica:</td><td>".$result->_idStanicaPolaska."</td></tr><tr><td>Izlazna stanica:</td><td>".$result->_idStanicaDolaska."</td></tr><tr><td>Povratna</td><td>".$povratna."</td></tr>"
            . "<tr><td>Popust:</td><td>".$result->_naznakaPopusta."</td></tr><tr><td>Cena:</td><td>".$result->_cena." din</td></tr></table>";
    }


}









