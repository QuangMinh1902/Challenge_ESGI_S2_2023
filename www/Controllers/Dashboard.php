<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\FormUser;
use App\Models\User;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Dashboard
{

    private $folder;

    public function __construct()
    {
        $this->folder = 'Dashboard';
    }

    function index()
    {
        $user = new User();
        $table = $user->getList();
        $view = new View($this->folder . "/index", "back");
        $numberUsers = $user->getTotalRows();
        $view->assign("table", $table);
        $view->assign("numberUsers", $numberUsers);
        // var_dump($table);
    }
}
