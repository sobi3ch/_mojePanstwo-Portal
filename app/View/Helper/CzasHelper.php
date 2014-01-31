<?php

class CzasHelper extends AppHelper
{

    public $strings = array(
        'miesiace' => array(
            'celownik' => array(
                1 => 'stycznia',
                2 => 'lutego',
                3 => 'marca',
                4 => 'kwietnia',
                5 => 'maja',
                6 => 'czerwca',
                7 => 'lipca',
                8 => 'sierpnia',
                9 => 'września',
                10 => 'października',
                11 => 'listopada',
                12 => 'grudnia',
            ),
        ),
    );

    public function wiek($data)
    {

        $birthDate = explode("-", substr($data, 0, 10));
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));

        return pl_dopelniacz($age, 'rok', 'lata', 'lat');

    }

    public function dataSlownie($data)
    {
        return dataSlownie($data);
    }

}