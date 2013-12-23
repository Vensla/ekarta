<?php

class Application_Model_Soap
{
    
    public function Soap(){
        $opcije = array(
            'location' => 'http://ps/Index/soap',
            'uri' => 'http://ps/Index/soap'
        );
    try {
        $klijent = new Zend_Soap_Client(null, $opcije);

        echo "<br/> uzmi kartu ";
        $karta = $klijent->getKarta();
        print_r($karta);

        echo "<br/> ulazne stanice ";
        var_dump($klijent->stanicaUlazna());


        $data = array(
            'idKarta' => 1,
            'idTrasa' => 0,
            'idStanicaPolaska' => 0,
            'idStanicaDolaska' => 0,
            'vremePolaska' => 0,
            'cena' => 0,
            'aktivnost' => 0
        );
        $karta = (object) $data;

        echo "<br/> nova karta: ";
        print_r($karta);

        echo "<br/> sacuvaj kartu: ";
        print_r($klijent->sacuvajKartu($karta));

        echo "<br/> pronadji kartu: ";
        print_r($klijent->pronadjiKartu(5));

        echo "<br/> daj popuste: ";
        print_r($klijent->popusti());
    } catch (SoapFault $s) {
        die('Error[' . $s->faultcode . ']' . $s->faultstring);
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }

        }
    

}

