<?php

class Application_Form_Naruci extends Zend_Form
{

    public function init()
    {
        $this->setAction('naruci')->setMethod('post');
        
        $ime = new Zend_Form_Element_Text('tbIme');
        $ime->class = 'form-control';
        $ime->setRequired(true);
        $ime->addValidator('regex', false, array('/^[\d]$/'))->addErrorMessage('Ime nije u dobrom formatu');
        
        $popust = new Zend_Form_Element_Select('ddlPopust');
        $popust->class = 'form-control';
        
        $povratna = new Zend_Form_Element_Checkbox('cbPovratna');
        $povratna->class = 'form-control';
        
        $submit = new Zend_Form_Element_Submit('btnNaruci');
        $submit->setLabel('Naruci');
        $submit->class = 'form-control btn-primary';
        
        $this->addElements(array($ime, $popust, $povratna, $submit));
        
    }


}

