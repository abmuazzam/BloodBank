<?php
    namespace Core;
    class Application{

        function __construct(){
            $this->_set_error_reporting();
        }
        private function _set_error_reporting(){
            switch(ENVIRONMENT){
                case 'Development':
                    error_reporting(E_ALL);
                    ini_set('display_errors',1);
                break;
                case 'Test':
                case 'Production':
                    error_reporting(E_ALL);
                    ini_set('log_errors',1);
                    ini_set('error_log',ROOT . DS . 'tmp'.'error.log');
                break;
                case 'Deployment':
                    error_reporting(0);
                    ini_set('display_errors',0);
                    ini_set('log_errors',1);
                    ini_set('error_log',ROOT . DS . 'tmp'.DS.'error.log');
                break;
            }
        }
    }
?>