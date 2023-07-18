<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Models\Layout;
class LayoutController{
    public function index(){
        $trim_params = trim($_SERVER['REQUEST_URI'],"/");
        $explode_string = explode(".", $trim_params);

        $model = new Layout();
        $menu = $model->getList('esgi_Menu');
        $post = $model->getList('esgi_Post', 'id', 'DESC');
        $comment = [];

        $slug = $explode_string[0];

        $h1 = '';
        $h2 = '';
        $content = '';
        $meta_title = '';
        $meta_description = '';
        $id = '';

        if(empty($trim_params))
        {
            $h1='Home';
            $h2='Home Layout';
            $meta_title = 'Home Page Layout'. " | Quang Minh";
            $meta_description='Home Page Layout'. " | Quang Minh";
            $view = new View("Layout/index", "front");
        }
        elseif(in_array('html' , $explode_string))
        {
            $detail = $model->getDetailSlug('esgi_post', $slug);
            // var_dump($detail);
            $id = $detail[0]['id'];
            $h1 = $detail[0]['title'];
            $content = $detail[0]['content']??'';
            $meta_title = $detail[0]['metatitle'];
            $meta_description=$detail[0]['metadescription'];

            $comment = $model->getDetail('esgi_comment', $id, 'postid', 'status=TRUE AND ');

            $view = new View("Layout/post", "front");
        }
        else{
            $detail = $model->getDetailSlug('esgi_category', $slug);
            $h1 = $detail[0]['title'];
            $meta_title = $detail[0]['title'];
            $meta_description=$detail[0]['title'];

            $view = new View("Layout/category", "front");
        }
        $view->assign("menu", $menu);
        $view->assign("post", $post);
        $view->assign("comment", $comment);
        $view->assign("id", $id);
        $view->assign("h1", $h1);
        $view->assign("content", $content);
        $view->assign("meta_title", $meta_title);
        $view->assign("meta_description", $meta_description);
    }
}