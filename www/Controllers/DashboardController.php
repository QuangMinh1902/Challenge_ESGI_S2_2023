<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Models\Menu;
use App\Models\Post;
use App\Models\User;
use App\Models\Token;
use App\Models\Category;

class DashboardController{
    function index(){
        if(empty($_SESSION["user"])){
            echo 'Please login folow link <a href="/login">Login</a>';
            die;
        }
        
        // check token
        $modelToken = new Token();
        $modelToken->setId($_SESSION["user"]['tokenid']);
        $row = $modelToken->getDetail();

        if($row[0]['status'] != 1){
            echo 'Token has expired. Please login folow link <a href="/login">Login</a>';
            die;
        }
        
        if($row[0]['expirationtime'] < time()){
            echo 'Token has expired. Please login folow link <a href="/login">Login</a>';
            die;
        }
        $view = new View("Dashboard/index", "back");
        $user = new User();
        $category = new Category();
        $menu = new Menu();
        $post = new Post();
        $postActivated= $post->getListByStatus();
        $postPending= $post->getListByStatus('false');
        $menuActivated= $menu->getListByStatus();
        $menuPending= $menu->getListByStatus('false');
        $usersActivated= $user->getListByStatus();
        $usersPending= $user->getListByStatus('false');
        $categoryActivated= $category->getListByStatus();
        $categoryPending= $category->getListByStatus('false');
        $view->assign("users", $usersActivated);
        $view->assign("usersPending", $usersPending);
        $view->assign("categoryActivated", $categoryActivated);
        $view->assign("categoryPending", $categoryPending);
        $view->assign("menuActivated", $menuActivated);
        $view->assign("menuPending", $menuPending);
        $view->assign("postActivated", $postActivated);
        $view->assign("postPending", $postPending);
    }
}
?>