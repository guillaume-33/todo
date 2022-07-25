<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class listController
{

    /**
     * @Route("/listes" , name="mes_listes")
     */
public function readlist(){
    dd('test'); //route OK
}

/**
 * @Route ("/liste", name="ajout_liste")
 */
    public function addListe(){
        dd('test');//route OK
    }
}