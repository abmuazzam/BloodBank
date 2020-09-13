<?php
    namespace Core;
    class Session{
        public static function start(){
            ini_set('session.cookie_httponly',1);
            if(!isset($_SESSION))
                session_start();
        }
        public static function end($name = ""){
            if($name){
                if(self::exists($name)){
                    unset($_SESSION[$name]);
                }
            }else{
                session_destroy();
            }
        }
        public static function set($name,$value){
            if(!self::exists($name)){
                $_SESSION[$name] = $value;
            }
        }
        public static function get($name){
            if(self::exists($name))
                return $_SESSION[$name];
            return false;
        }
        public static function addMessage($type,$message){
            $msg = "<div class='alert alert-".$type." alert-dismissible fade show' role='alert'>";
            $msg.=$message;
            $msg.='<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
            $msg.="</div>";
            self::set('message',$msg);
        }
        public static function getMessage(){
            if(self::exists('message')) {
                $msg = self::get('message');
                self::end('message');
                return $msg;
            }
        }
        public static function exists($name){
            if(isset($_SESSION[$name]))
                return true;
            return false;
        }
        public static function user_agent_no_version(){
            $uagent = $_SERVER['HTTP_USER_AGENT'];
            $regx = '/\/[a-zA-Z0-9.]+/';
            $newString = preg_replace($regx,'',$uagent);
            return $newString;
        }
        public static function user_server_name(){
            $ip = $_SERVER['REMOTE_ADDR'];
            $server = gethostbyaddr($ip);
            return $server;
        }
    }
?>