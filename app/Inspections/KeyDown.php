<?php

namespace App\Inspections;

use Exception;

class KeyDown {

    public function detect($body) {
        if(preg_match('/(.)\\1{6,}/', $body)){
            throw new Exception('Key Held Down');
        }
    }

}

