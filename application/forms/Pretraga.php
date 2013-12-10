<?php

class Application_Form_Pretraga extends Zend_Form
{

    public function init()
    {
        $this->setAction('naslovna')->setMethod('post');
        
        $od = new Zend_Form_Element_Text('tbOd');
        $od->class = 'form-control';
        $od->setRequired(true);
        $od->addValidator('regex', false, array('/^[A-Z]*[a-z]*$/'))->addErrorMessage('Stanica nije u dobrom formatu!');
        $od->setAttribs(array('placeholder'=>'Polazak','list'=>'Stanice'));
        
        $do = new Zend_Form_Element_Text('tbDo');
        $do->class = 'form-control';
        $do->setRequired(true);
        $do->addValidator('regex', false, array('/^[A-Z]*[a-z]*$/'))->addErrorMessage('Stanica nije u dobrom formatu!');
        $do->setAttribs(array('placeholder'=>'Odredište','list'=>'Stanice'));
        
        $datum = new Zend_Form_Element_Text('tbDatum');
        $datum->class = 'form-control';
        $datum->setRequired(true);
        $datum->addValidator('regex', false, array('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/'))->addErrorMessage('Datum nije u dobrom formatu!');
        $datum->setAttribs(array('placeholder'=>'Datum','id'=>'datepicker'));
        
        $submit = new Zend_Form_Element_Submit('btnLista');
        $submit->setLabel('Pronađi rutu');
        $submit->class = 'form-control btn btn-primary';
        
        $this->addElements(array($od,$do,$datum));
        
        $od->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'),array('tag' => 'div','class'=>'col-sm-4'))
            
        ));
        
        $do->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'),array('tag' => 'div','class'=>'col-sm-4'))       
        ));
        
        $datum->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'),array('tag' => 'div','class'=>'col-sm-4'))
            
        ));
        
        $this->setDecorators(array('FormElements',
            array('HtmlTag', array('tag' => 'div', 'class'=>'form-group')),
           
            'Form'
            
        ));
        
        $this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'),array('tag' => 'td', 'class'=>'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ), array($od,$do));
    }


}

