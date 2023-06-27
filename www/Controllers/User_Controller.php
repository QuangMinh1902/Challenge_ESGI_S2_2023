<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\FormUser;
use App\Models\User;
use App\Core\Verificator;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class User_Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'User';
    }

    function index()
    {
        $user = new User();
        $table = $user->getList();
        $view = new View($this->folder . "/index", "back");
        $view->assign("table", $table);
    }

    function insert(): void
    {
        // show view
        $form = new FormUser();
        $view = new View($this->folder . "/form", "back");
        $view->assign('form', $form->getConfig());
        // end

        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        if ($form->isSubmit()) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $pwdConfirm = $_POST["pwdConfirm"];
            if ($pwd == $pwdConfirm) {
                $user = new User();
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPassword($pwd);
                $user->setDateUpdated();
                $user->save();
                header('Location: ' . $actual_link . '/admin/' . strtolower($this->folder) . '/index');
                exit();
            } else {
                echo "<script> alert('password does not match') </script>";
            }
        }
    }

    function update()
    {
        $form = new FormUser();
        $user = new User();
        $user->setId($_GET['id']);
        $row = $user->getDetail();
        $view = new View($this->folder . "/form", "back");
        $view->assign('form', $form->getConfig($row));

        if ($form->isSubmit()) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];

            $user = new User();

            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setId($_GET['id']);
            $user->setDateUpdated();
            $user->save();
            header('Location: ' . $actual_link . '/admin/' . strtolower($this->folder) . '/update?id=' . $user->getId());
            exit();
        }
    }

    function delete()
    {
        $user = new User();
        $user->setId($_POST["id"]);

        $result = (count($user->getDetail()) == 0) ? 'Data doesn\'t exist.' : '';
        $user->delete();

        echo $result;
    }

    function status()
    {
        $user = new User();
        $user->setId($_POST["id"]);

        $result = (count($user->getDetail()) == 0) ? 'Data doesn\'t exist.' : '';

        $user->setStatus(strtoupper($_POST['status']));
        $user->status();

        echo $result;
    }

    function login()
    {
        $view = new View($this->folder . "/login", "login");
    }

    function processlogin()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setEmail($email);

        $check_email = $user->checkEmail();
        print_r($check_email);
        die;

        $user->setPassword($password);
        $user->setStatus('TRUE');
    }
}
