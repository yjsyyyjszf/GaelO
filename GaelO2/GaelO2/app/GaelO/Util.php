<?php

namespace App\GaelO;

use Carbon\Carbon;

class Util {

    public static function fillObject (array $dataToExtract, object $dataToFill) {
        foreach($dataToExtract as $property => $value) {
            if (isset($value)) $dataToFill->$property = $dataToExtract[$property];
        }
        return $dataToFill;
    }

    public static function now() {
        return Carbon::now()->format('Y-m-d H:i:s.u');
        //SK A TESTER TRACKER A BESOIN DE MILISEC MAIS LARAVEL SEMBLE PAS TOUJOURS SUPPORTER
        //LES DATE GENEREES SONT PASSEE EN 6 PRECISION DANS LES MIGRATION
        //return now()->toDateTimeString();
    }
}

?>