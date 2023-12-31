<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Models\Comment;
use App\Core\Verificator;

class CommentController {
    private $folder;

    public function __construct(){
        $this->folder = ucfirst(explode('/',$_SERVER['REQUEST_URI'])[2]);
    }

    function index(){
        $model = new Comment();
        $table = $model->getList('', 'id');
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert()
    {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postid = $_POST["postid"];
        $model = new Comment();
        $model->setTitle($title);
        $model->setContent($content);
        $model->setPostId($postid);
        $model->save();
        echo 'Send Successfully!!';
    }

    function update(){
        $model = new Comment();
        $model->setId($_POST['id']);
        $model->setReply($_POST['reply']);
        $model->setUserId($_SESSION["user"]['id']);
        $model->save();
        echo 'Reply Successfully!!';
    }

    function delete(){
        if(trim($_SESSION["user"]['role']) != 'admin'){
            echo 'You are not enough role';
            die;
        }
        $model = new Comment();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Data does not exist.' : '';
        $model->delete();
        echo $result;
    }

    function status(){
        if(trim($_SESSION["user"]['role']) != 'admin'){
            echo 'You are not enough role';
            die;
        }
        $model = new Comment();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Data does not exist.' : '';
        $model->setStatus(strtoupper($_POST['status']));
        $model->status();
        echo $result;
    }
}
