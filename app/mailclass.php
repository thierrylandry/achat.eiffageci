<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 14/11/2018
 * Time: 10:02
 */

namespace App;


class mailclass
{
    public $objet,$corp;
    public function __construct($objet,$corp)
    {
        //
        $this->objet=$objet;
        $this->corps=$corp;

    }

}