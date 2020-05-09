<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords {

    protected $keywords = [
        "yahoo customer support"
    ];

    public function detect($body) {
        foreach ($this->keywords as $invalid) {
            if(stripos($body, $invalid) !== false){
                throw new Exception("Invalid words");
            }
        }
    }

}
