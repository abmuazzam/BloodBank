<?php
    namespace Core;
    use Core\Helpers\Request_Helper as Request;
    use Core\Application as Application;
    class Controller extends Application {
        protected $view,$request;
        function __construct(){
            parent::__construct();
            $this->view = new View();
            $this->request = new Request();
        }
    }
?>