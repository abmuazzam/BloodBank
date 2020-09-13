<?php
    namespace Core;
    class View{
        private $_layout = DEFAULT_LAYOUT,$_title = TITLE,$_content = [],$_buffer;
        public function render($viewName,$title = "", $data = false){
            if($title){
                $this->_title = $title;
            }
            if($data){
                if(is_array($data)){
                    extract($data);
                }
            }
            $view = ROOT . DS . "application" .DS ."view" . DS . $viewName . ".php";
            $layout = ROOT . DS . "application" .DS ."view" . DS . "layout" . DS . $this->_layout . ".php";
            if(file_exists($view)){
                require_once $view;
                require_once $layout;
            }else{
                echo "View Not Found";
            }
        }
        public function setLayout($layout){
            $this->_layout = $layout;
        }

        public function start($type){
            if(empty($type)) die("You must define type");
            $this->_buffer = $type;
            ob_start();
        }

        public function end(){
            if(!empty($this->_buffer)){
                $this->_content[$this->_buffer] = ob_get_clean();
                $this->_buffer = null;
            }else{
                die("You must run start first");
            }
        }

        public function section($type){
            if(array_key_exists($type,$this->_content)){
                return $this->_content[$type];
            }else{
                return false;
            }
        }

        public function insert($partial){
            $p = ROOT . DS . "application" . DS . "view" . DS . "partials" . DS . $partial. ".php";
            if(file_exists($p)){
                include $p;
            }
        }
        public function partial($group,$partial){
            $p = ROOT . DS . "application" . DS . "view" . DS . $group . DS . "partials" . DS . $partial. ".php";
            if(file_exists($p)){
                include $p;
            }
        }
        public function assets($path){
            $file = "public/".$path;
            if(file_exists($file)){
                return $file;
            }
        }
    }
?>