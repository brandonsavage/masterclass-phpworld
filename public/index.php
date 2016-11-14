<?php

session_start();

$config = require_once('../config.php');
require_once '../MasterController.php';

require '../vendor/autoload.php';

$request = new \Masterclass\Request\Request($_GET, $_POST, $_SESSION, $_SERVER);
$router = new \Masterclass\Routing\Router($request, $config['routes']);

$framework = new MasterController($request, $router, $config);
echo $framework->execute();