<?php
    if(php_sapi_name() != 'cli') die("Restricted");
    define('DS',DIRECTORY_SEPARATOR);
    define('ROOT',__DIR__);
    $fileName = "Migration_Fuce_".time();
    $ext = ".php";
    $fullPath = ROOT . DS . 'Migrations' . DS .$fileName.$ext;
    $content = '<?php
        namespace Migrations;
        use Core\Migration;
        class '.$fileName.' extends Migration{
            public function up(){
            
            }
        }
    ?>';
    $resp = file_put_contents($fullPath,$content);
?>