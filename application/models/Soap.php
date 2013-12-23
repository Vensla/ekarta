<?php

class Application_Model_Soap
{
    protected $klijent;
    public function Soap()
    {
        $opcije = array(
            'location' => 'http://ps/Index/soap',
            'uri' => 'http://ps/Index/soap'
        );
        try {
            $this->klijent = new Zend_Soap_Client(null, $opcije);
       
        } catch (SoapFault $s) {
            die('Error[' . $s->faultcode . ']' . $s->faultstring);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }

    }
    public function getUlazneStanice()
    {
        return $this->klijent->stanicaUlazna();
    }
    

}

