<?php
    use Core\Session;
    use Core\Router;
    date_default_timezone_set("Asia/Kolkata");
    define('ROOT',__DIR__);
    define('DS',DIRECTORY_SEPARATOR);
    require_once ROOT . DS . 'config' . DS . 'config.php';
    require_once ROOT . DS . 'core' . DS .'Bootstrap.php';
    Session::start();
    Router::route();
?>
