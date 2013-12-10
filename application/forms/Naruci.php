<?php

class Application_Form_Naruci extends Zend_Form
{

    public function init()
    {
        $this->setAction('naruci')->setMethod('post');
        $popust = new Zend_Form_Element_Select('ddlPopust');
        $popust->class = 'form-control';
        $povratna = new Zend_Form_Element_Checkbox('cbPovratna');
        $povratna->class = 'form-control';
        
    }


}

