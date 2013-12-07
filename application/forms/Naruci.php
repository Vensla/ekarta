<?php

class Application_Form_Naruci extends Zend_Form
{

    public function init()
    {
        $this->setAction('naruci')->setMethod('post');
        
        $od = new Zend_Form_Element_Text('tbOd');
        $od->class = 'form-control';
        $od->setRequired(true);
        $od->addValidator('regex', false, array('/^[A-Z]*[a-z]*$/'))->addErrorMessage('Niste izabrali odgovarajuću stanicu!');
        
    }


}

