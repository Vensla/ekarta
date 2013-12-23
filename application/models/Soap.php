<?php

class Application_Model_Soap
{
    protected $klijent;
    public function Application_Model_Soap()
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
    
    public function getIzlazneStanice($id)
    {
        return $this->klijent->stanicaIzlazna($id);
    }
    
    public function getRuta()    
    {
        return $this->klijent->pronadjiRutu();
    }

}
