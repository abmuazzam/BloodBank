<?php
    namespace Core\Helpers;
    class Encryption_Helper{

        public static function make_hash($password){
            return password_hash($password,PASSWORD_ENC);
        }
        public static function verify($password,$hashedPassword){
            return password_verify($password,$hashedPassword);
        }
        public static function encrypt($text){
            $encrypted = base64_encode(base64_encode(base64_encode($text)));
            return $encrypted;
        }
        public static function decrypt($text){
            $decrypted = base64_decode(base64_decode(base64_decode($text)));
            return $decrypted;
        }
    }
?>