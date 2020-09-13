<?php
    function autoload($class){
        $classAry = explode(DS,$class);
        $class = array_pop($classAry);
        $subpath = strtolower(implode(DS,$classAry));
        $path = ROOT . DS . $subpath . DS . $class . ".php";
        if(file_exists($path)){
            require_once $path;
        }
    }
    spl_autoload_register('autoload');
?>
