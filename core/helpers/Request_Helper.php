<?php
    namespace Core\Helpers;
    use Core\Helpers\Form_Helper as FH;
    class Request_Helper{

        public function isPost(){
            return $this->getRequestMethod()=== "POST";
        }
        public function isGet(){
            return $this->getRequestMethod()=== "GET";
        }
        public function isPut(){
            return $this->getRequestMethod()=== "PUT";
        }
        private function getRequestMethod(){
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }
        public function get($input = false){
            if(!$input){
                $data = [];
                foreach($_REQUEST as $field => $value){
                    $data[$field] = trim(FH::sanitize($value));
                }
                return $data;
            }
            return (array_key_exists($input,$_REQUEST)) ? trim(FH::sanitize($_REQUEST[$input])) : '';
        }
        public function csrfCheck(){
            if(!FH::checkCsrf($this->get(CSRF_FIELD)))
                \Router::redirect('Error/badToken');
            return true;
        }
    }
?>