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
    
    public function getRuta($ulazna, $izlazna, $datum)    
    {
        return $this->klijent->pronadjiRutu($ulazna, $izlazna, $datum);
    }
    
    public function getPopusti()    
    {
        return $this->klijent->popusti();
    }
    
    public function getRedVoznje($id)    
    {
        return $this->klijent->getVoznja($id);
    }
    
    public function napraviKartu($obj)    
    {
        return $this->klijent->sacuvajKartu($obj);
    }
    
    public function napraviObjKarte()    
    {
        return $this->klijent->getKarta();
    }
    
     public function nadjiKartu($id)    
    {
        return $this->klijent->pronadjiKartu($id);
    }
    
    public function cenaKarte($idTrasa, $idPolazneStanice, $idDolazneStanice, $idPopust, $povratna)    
    {
        return $this->klijent->izracunajCenuKarte($idTrasa, $idPolazneStanice, $idDolazneStanice, $idPopust, $povratna);
    }

}
