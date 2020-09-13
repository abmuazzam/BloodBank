<?php
    use Core\Database;
    define('DS',DIRECTORY_SEPARATOR);
    define('ROOT',__DIR__);
    require_once ROOT . DS . 'config' . DS . 'config.php';
    $isCli = php_sapi_name() == 'cli';
    if(!RUN_MIGRATION_FROM_BROWSER && !$isCli) die('Restricted');
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
    $db = Database::connect();
    $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
    $previousMig = [];
    $migrationsRun = [];
    if(!empty($migrationTable)){
        $query = $db->query("SELECT migration FROM migrations")->results();
        foreach($query as $q){
            $previousMig[] = $q->migration;
        }
    }
    $migrations = glob('Migrations' . DS . '*.php');
    foreach($migrations as $fileName){
        $klass = str_replace('Migrations'.DS,'',$fileName);
        $klass = str_replace('.php','',$klass);
        if(!in_array($klass,$previousMig)){
            $kNamespace = 'Migrations\\'.$klass;
            $mig = new $kNamespace($isCli);
            $mig->up();
            $db->insert('migrations',['migration'=>$klass]);
            $migrationsRun[] = $kNamespace;
        }
    }
    if(sizeof($migrationsRun)==0){
        if($isCli){
            echo "\e[0;37;42m\n\n"." No new migrations to run.\n\e[0m\n";
        }else{
            echo "<p style='color:#006600'>No new migrations to run</p>";
        }
    }
?>
