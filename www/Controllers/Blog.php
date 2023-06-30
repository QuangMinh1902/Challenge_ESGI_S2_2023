<?php
namespace App\Controllers;
use App\Core\View;

class Blog{
    function index(){
         $view = new View("Blog/blog", "front");
    }
}
?>