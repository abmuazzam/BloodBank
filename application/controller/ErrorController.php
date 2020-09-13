<?php
    namespace Application\Controller;
    use Core\Controller as Controller;
    class ErrorController extends Controller {
        public function index(){
            echo "404 Not Found";
        }
        public function badToken(){
            echo "Token Not Found";
        }
    }
?>