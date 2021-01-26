<?php

//This is my CONTROLLER

error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Define a default route (home page)
$f3->route('GET /', function() {
    //echo "My Food Page";
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a default route (home page)
$f3->route('GET /@first/@last', function($f3, $params) {
    echo "Hello, ".$params['first']." ".$params['last'];
});

//Define a "breakfast" route
$f3->route('GET /breakfast', function() {
    //echo "Breakfast";
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

//Define a "lunch" route
$f3->route('GET /lunch', function() {

    $view = new Template();
    echo $view->render('views/lunch.html');
});

//Define a "lunch/sandwich" route
$f3->route('GET /lunch/sandwiches', function() {

    $view = new Template();
    echo $view->render('views/sandwich.html');
});

$f3->route('GET /breakfast/@item', function($f3, $params) {

    var_dump($params);
    $menu = array('eggs', 'waffles', 'pancakes');
    $item = $params['item'];
    if (in_array($item, $menu)) {
        switch($item) {
            case 'eggs':
                $view = new Template();
                echo $view->render('views/eggs.html');
                break;
            case 'pancakes':
                echo "Swedish or American?";
                break;
            case 'waffles':
                $f3->reroute("http://thewafflehouse.com");
                break;
            default:
                $f3->error(404);
        }
    }
    else {
        echo "Sorry, we don't serve $item";
    }
    //$view = new Template();
    //echo $view->render('views/breakfast.html');
});

//Run fat free
$f3->run();
