<?php
    
namespace App\Core;

class Error{

    public static function Show404(){
        http_response_code(404);
        new View("Error/page404", "front");
        die();
    }

    public function Show500(){
        http_response_code(500);
        die();
    }

}