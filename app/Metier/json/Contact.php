<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 16/08/2017
 * Time: 17:44
 */

namespace App\Metier\Json;


class Contact extends Serializable
{
    public static $typeListe = [
        "EMA" => "Email",
        "MOB" => "Mobile",

    ];

    public $titre_c;
    public $type_c;
    public $valeur_c;

    public static function getContactString($name)
    {
        if (key_exists($name, self::$typeListe)) {
            return self::$typeListe[$name];
        } else {
            return null;
        }
    }

    public function __get($name)
    {
        return self::getContactString($name);
    }

}