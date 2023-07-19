<?php
namespace App;
//Contrainte : utilisation des Namespace
include './Core/Define.php';

spl_autoload_register(function ($class) {
    //Core/View.php
    $class = str_replace("App\\","", $class);
    $class = str_replace("\\","/", $class).".php";
    if(file_exists($class)){
        include $class;
    }
});


$uriExploded = explode("?",$_SERVER["REQUEST_URI"]);
$uri = rtrim(strtolower(trim($uriExploded[0])),"/");
$uri = (empty($uri))?"/":$uri;



if(!file_exists("routes.yml")) {
    die("Le fichier de routing n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

// Not found url in routes.yml
if(empty($routes[$uri])) {
    $routes[$uri]["controller"] = 'LayoutController';
    $routes[$uri]["action"] = 'index';
}

if(empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])) {
    die("Absence de controller ou d'action dans le ficher de routing pour la route ".$uri);
}

$controller = $routes[$uri]["controller"];
$action = $routes[$uri]["action"];

//Vérification de l'existance de la classe
if(!file_exists("Controllers/".$controller.".php")){
    die("Le fichier Controllers/".$controller.".php n'existe pas");
}

include "Controllers/".$controller.".php";

//Le fichier existe mais est-ce qu'il possède la bonne classe
//bien penser à ajouter le namespace \App\Controllers\Security
$controller = "\\App\\Controllers\\".$controller;
if(!class_exists($controller)){
    die("La class ".$controller." n'existe pas");
}

$objet = new $controller();

//Est-ce que l'objet contient bien la methode
if(!method_exists($objet, $action)){
    die("L'action ".$action." n'existe pas");
}

$objet->$action();








