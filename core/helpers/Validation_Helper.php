<?php
    namespace Core\Helpers;
    class Validation_Helper{
        public $patterns = array(
            'uri'       =>  '[A-Za-z0-9-\/_?&=]+',
            'url'       =>  '[A-Za-z0-9-:.\/_?&=#]+',
            'alpha'     =>  '[\p{L}]+',
            'words'     =>  '[\p{L}\s]+',
            'alphanum'  =>  '[\p{L}0-9]+',
            'int'       =>  '[0-9]+',
            'float'     =>  '[0-9\.,]+',
            'tel'       =>  '[0-9+\s()-]+',
            'text'      =>  '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
            'file'      =>  '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
            'folder'    =>  '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
            'address'   =>  '[\p{L}0-9\s.,()°-]+',
            'date_dmy'  =>  '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
            'date_ymd'  =>  '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
            'email'     =>  '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.+[a-z-A-Z]'
        );
        public $errors = array();

        public function name($name){
            if(is_array($name)){
                $this->name = $name[0];
                $this->messageName = $name[1];
            }else{
                $this->name = $name;
                $this->messageName = $name;
            }
            return $this;
        }
        public function value($value){
            $this->value = $value;
            return $this;
        }
        public function file($value){
            $this->file = $value;
            return $this;
        }
        public function pattern($name){
            if($name=='array'){
                if(!is_array($this->value)){
                    $this->errors[$this->name]['message'] = 'Invalid ' . ucwords($this->messageName). ' format';
                }
            }else{
                $regex = '/^('.$this->patterns[$name].')$/u';
                if($this->value!='' && !preg_match($regex,$this->value)){
                    $this->errors[$this->name]['message'] = 'Invalid ' . ucwords($this->messageName). ' format';
                }
            }
            return $this;
        }
        public function customPattern($pattern){
            $regex = '/^('.$pattern.')$/u';
            if($this->value!='' && !preg_match($regex,$this->value)){
                $this->errors[$this->name]['message'] = 'Invalid ' . ucwords($this->messageName). ' format';
            }
            return $this;
        }

        public function required(){
            if((isset($this->file) && $this->file['error']==4) || ($this->value == '' || $this->value==null)){
                $this->errors[$this->name]['message'] = ucwords($this->messageName)." is required";
            }
            return $this;
        }
        public function min($length){
            if(is_string($this->value)){
                if(strlen($this->value)<$length){
                    $this->errors[$this->name]['message'] = ucwords($this->messageName)." value is less than the minimum value";
                }
            }else{
               if($this->value < $length){
                   $this->errors[$this->name]['message'] = ucwords($this->messageName)." value is less than the minimum value";
               }
            }
            return $this;
        }
        public function max($length){
            if(is_string($this->value)){
                if(strlen($this->value)>$length){
                    $this->errors[$this->name]['message'] = ucwords($this->messageName)." value is higher than the maximum value";
                }
            }else{
                if($this->value > $length){
                    $this->errors[$this->name]['message'] = ucwords($this->messageName)." value is higher than the maximum value";
                }
            }
            return $this;
        }
        public function equal($value){
            if($this->value!= $value){
                $this->errors[$this->name]['message'] = ucwords($this->messageName)." value is not corresponding";
            }
            return $this;
        }
        public function maxSize($size){
            if($this->file['error'] != 4 && $this->file['size']>$size){
                $this->errors[$this->name]['message'] = ucwords($this->messageName)." exceeds the maximum size of".number_format($size/1048576,2)." MB.";
            }
            return $this;
        }
        public function ext($extension){
            if($this->file['error'] !=4 && patinfo($this->file['name'],PATHINFO_EXTENSION) != $extension && strtoupper(pathinfo($this->file['name'],PATHINFO_EXTENSION))!=$extension){
                $this->errors[$this->name]['message'] = ucwords($this->messageName)." it's not a ".$extension.".";
            }
            return $this;
        }
        public function isSuccess(){
            return (empty($this->errors));
        }
        public static function is_int($value){
            return (filter_var($value,FILTER_VALIDATE_INT));
        }
        public static function is_float($value){
            return (filter_var($value,FILTER_VALIDATE_FLOAT));
        }
        public static function is_alpha($value){
            return (filter_var($value,FILTER_VALIDATE_REGEXP,array('options'=>array('regexp'=>"/^[a-zA-Z]+$/"))));
        }
        public static function is_alphanum($value){
            return (filter_var($value,FILTER_VALIDATE_REGEXP,array('options'=>array('regexp'=>"/^[a-zA-Z0-9]+$/"))));
        }
        public static function is_url($value){
            return (filter_var($value,FILTER_VALIDATE_URL));
        }
        public static function is_uri($value){
            return (filter_var($value,FILTER_VALIDATE_REGEXP,array('options'=>array('regexp'=>"/^[a-zA-Z0-9-\/_]+$/"))));
        }
        public static function is_bool($value){
            return (filter_var($value,FILTER_VALIDATE_BOOLEAN,FILTER_NULL_ON_FAILURE));
        }
        public static function is_email($value){
            return (filter_var($value,FILTER_VALIDATE_EMAIL));
        }
        public static function sanitize($param){
            $param = htmlentities($param);
            return filter_var($param,FILTER_SANITIZE_STRING);
        }
        public static function string($param){
            if(preg_match('%^[A-Za-z0-9 \.\&\)\'\%(\-\/\!\\\;\?\:\,]{2,200}$%',$param))
                return true;
            return false;
        }
        public static function mobile($param){
            if(preg_match('%^[0-9 )(+-]{10,16}$%',$param))
                return true;
            return false;
        }
        public static function date($param){
            $param = date('d-m-Y',strtotime($param));
            if(preg_match('%^[0-9]{1,2}+[-/]+[0-9]{1,2}+[-/]+[0-9]{2,4}$%',$param))
                return true;
            return false;
        }
        public static function text($param){
            if(preg_match("%^[A-Za-z0-9 \r?\n\-\_\?\!\,\.\&\%\)\(\'\\\;\/\#\:\|\"]{6,500}$%",$param))
                return true;
            return false;
        }
        public static function time($param){
            $param = date('H:i A',strtotime($param));
            if(preg_match('%^[0-9]{1,2}+[:]+[0-9]{1,2}+[ ]+[A-Za-z]{2,2}$%',$param))
                return true;
            return false;
        }
    }
?>