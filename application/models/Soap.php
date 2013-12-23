<?php

class Application_Model_Soap
{
    
    public function Soap()
    {
        $klijent = null;
        $opcije = array(
            'location' => 'http://ps/Index/soap',
            'uri' => 'http://ps/Index/soap'
        );
        try {
            $klijent = new Zend_Soap_Client(null, $opcije);
       
        } catch (SoapFault $s) {
            die('Error[' . $s->faultcode . ']' . $s->faultstring);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }

    }
    public function getUlazneStanice()
    {
        $klijent->stanicaUlazna();
        return $klijent;
    }
    

}

