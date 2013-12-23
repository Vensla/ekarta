<?php

class Application_Form_Pretraga extends Zend_Form
{

    public function init()
    {
        $this->setAction('naslovna')->setMethod('post');
        
        $od = new Zend_Form_Element_Select('ddlOd');
        $od->class = 'form-control';
        $od->setRequired(true);
        $od->setMultiOptions(array(
            0 => 'Beograd',
            1 => 'Pancevo',
            2 => 'Stara Pazova'
        ));
        $do = new Zend_Form_Element_Select('tbDo');
        $do->class = 'form-control';
        $do->setRequired(true);
        
        $datum = new Zend_Form_Element_Text('tbDatum');
        $datum->class = 'form-control';
        $datum->setRequired(true);
        $datum->addValidator('regex', false, array('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/'))->addErrorMessage('Datum nije u dobrom formatu!');
        $datum->setAttribs(array('placeholder'=>'Datum','id'=>'datepicker'));
        
        $submit = new Zend_Form_Element_Submit('btnLista');
        $submit->setLabel('Pronađi rutu');
        $submit->class = 'form-control btn-primary';
        
        $this->addElements(array($od,$do,$datum,$submit));
        
        $this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'),array('tag' => 'div', 'class'=>'col-sm-3'))
        ));

        $this->setDecorators(array('FormElements',
            array('HtmlTag', array('tag' => 'div', 'class'=>'form-group')),
            'Form'
        ));
    }


}
