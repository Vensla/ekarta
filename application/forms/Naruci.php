<?php

class Application_Form_Naruci extends Zend_Form
{

    public function init()
    {
        $this->setAction('naruci')->setMethod('post');
        
        $popust = new Zend_Form_Element_Select('ddlPopust');
        $popust->class = 'form-control';
        $model = new Application_Model_Soap();
        $popusti = $model->getPopusti();
        $popust->addMultiOption(0, 'Izaberite popust...');
        foreach($popusti as $p){
            $popust->addMultiOption($p->_idPopust,$p->_naziv);
        }
        
        $povratna = new Zend_Form_Element_Select('ddlPovratna');
        $povratna->class = 'form-control';
        $povratna->addMultiOptions(array(5 => 'Povratna...', 1 => 'Da', 0 => 'Ne'));
        
        $submit = new Zend_Form_Element_Submit('btnNaruci');
        $submit->setLabel('Naručite');
        $submit->class = 'form-control btn-primary';
        
        $this->addElements(array($popust, $povratna, $submit));
        
        $this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'),array('tag' => 'div', 'class'=>'col-sm-4'))
        ));

        $this->setDecorators(array('FormElements',
            array('HtmlTag', array('tag' => 'div', 'class'=>'form-group')),
            'Form'
        ));
        
    }


}

