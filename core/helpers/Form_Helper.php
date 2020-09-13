<?php
namespace Core\Helpers;
    class Form_Helper{
        public static function startForm($method,$action,$extra = [],$enctype=""){
            $form = "<form action='{$action}' method='{$method}' enctype='{$enctype}'>";
            $form.= self::csrfInput();
            return $form;
        }
        public static function endForm(){
            return "</form>";
        }
        public static function inputBlock($type,$name,$value='',$label='',$extra = [],$errors=[],$divClass = 'form-group'){
            if($type=='radio'){
                echo "Instead of inputBlock use Radio";
                return false;
            }elseif ($type=='checkbox'){
                echo "Instead of inputBlock use Checkbox";
                return false;
            }
            $input='<div class="'.$divClass.'">';
            if($label){
                $input.='<label for="'.$name.'">'.$label.'</label>';
            }
            $input.='<input type="'.$type.'"  id="'.$name.'" value="'.$value.'" name="'.$name.'"';
            $input.= self::stringfy($extra);
            $input.='>';
            if(!empty($errors)){
                if(array_key_exists('text',$errors)){
                    $input.='<small class="'.$errors['text'].'">'.$errors['message'].'</small>';
                }
            }
          $input.='</div>';
          return $input;
        }
        public static function select($name,$options = [],$selectedValue='',$label='',$extra = [],$errors=[],$divClass='form-group'){
            $select = "<div class='{$divClass}'>";
                if($label){
                    $select.="<label for='{$name}'>{$label}</label>";
                }
                $select .= "<select name='{$name}' id='{$name}'";
                $select.= self::stringfy($extra);
                $select.=">";
                    if(count($options)>0){
                        $select.="<option value=''>-- Select --</option>";
                        foreach($options as $option => $value){
                            $selected = ($option==$selectedValue)? "selected" : "";
                            $select.= "<option value='".$option."' {$selected}>".$value."</option>";
                        }
                    }else{
                        $select.="<option value=''>No Options</option>";
                    }
                $select.= "</select>";
                if(!empty($errors)){
                    if(array_key_exists('text',$errors)){
                        $select.='<small class="'.$errors['text'].'">'.$errors['message'].'</small>';
                    }
                }
            $select.="</div>";
            return $select;
        }
        public static function radio($name,$options = [],$selectedValue='',$label='',$extra = [],$errors=[],$divClass='form-group'){
            $count=0;
            $radio = "<div class='{$divClass}'>";
                foreach($options as $key => $value){
                    $count++;
                    $radio.=" <input type='radio' name='{$name}' id='".$name.$count."' value='{$key}'";
                    $radio.= ($selectedValue == $key) ? "checked" : "";
                    $radio.= self::stringfy($extra);
                    $radio.=" /> ";
                    $radio.="<label for='".$name.$count."'>".ucwords($value)."</label>";
                }
            if(!empty($errors)){
                if(array_key_exists('text',$errors)){
                    $radio.='<small class="'.$errors['text'].'">'.$errors['message'].'</small>';
                }
            }
            $radio.="</div>";
            return $radio;
        }
        public static function checkbox($name,$options = [],$selectedValue='',$label='',$extra = [],$errors=[],$divClass='form-group'){
            $count=0;
            $checkbox = "<div class='{$divClass}'>";
            foreach($options as $key => $value){
                $count++;
                $checkbox.=" <input type='checkbox' name='{$name}[]' id='".$name.$count."' value='{$key}'";
                $checkbox.=($selectedValue == $key) ? "checked" : "";
                $checkbox.= self::stringfy($extra);
                $checkbox.=" /> ";
                $checkbox.="<label for='".$name.$count."'>".ucwords($value)."</label>";
            }
            if(!empty($errors)){
                if(array_key_exists('text',$errors)){
                    $checkbox.='<small class="'.$errors['text'].'">'.$errors['message'].'</small>';
                }
            }
            $checkbox.="</div>";
            return $checkbox;
        }
        public static function textarea($name,$value='',$label='',$extra = [],$errors=[],$divClass = 'form-group'){
            $input='<div class="'.$divClass.'">';
            if($label){
                $input.='<label for="'.$name.'">'.$label.'</label>';
            }
            $input.="<textarea name='{$name}'";
            $input.= self::stringfy($extra);
            $input.=">".trim($value)."</textarea>";
            if(!empty($errors)){
                if(array_key_exists('text',$errors)){
                    $input.='<small class="'.$errors['text'].'">'.$errors['message'].'</small>';
                }
            }
            $input.='</div>';
            return $input;
        }
        public static function submit($value,$extra = [],$divClass='form-group'){
            $btn = "<div class='{$divClass}'>";
                $btn.="<input type='submit' value='{$value}'";
                    $btn.= self::stringfy($extra);
                $btn.="/>";
            $btn.="</div>";
            return $btn;
        }
        public static function stringfy($params){
            $string ="";
            if(!empty($params)){
                foreach($params as $key => $value){
                    $string.=" $key = '".$value."'";
                }
            }
            return $string;
        }
        public static function generateCsrf(){
            $token = base64_encode(openssl_random_pseudo_bytes(50));
            \Session::set(CSRF_TOKEN,$token);
            return $token;
        }
        public static function csrfInput(){
            return "<input type='hidden' name='".CSRF_FIELD."' id='".CSRF_FIELD."' value='".self::generateCsrf()."' />";
        }
        public static function checkCsrf($token){
            return (\Session::exists(CSRF_TOKEN) && \Session::get(CSRF_TOKEN)==$token);
        }
        public static function sanitize($param){
            $param = stripslashes($param);
            $param = htmlspecialchars($param,ENT_QUOTES,'UTF-8');
            $param = htmlentities($param);
            $param = addslashes($param);
            $param = strip_tags($param);
            $param = str_replace("`","",$param);
            return $param;
        }
        public static function displayErrors($errors = [],$divClass='bg-light',$ulClass='list-unstyled'){
            $html = "";
            if(!empty($errors)){
                $html .= "<div class='{$divClass}'>";
                    $html .="<ul ";
                    $html.=($ulClass) ? "class='{$ulClass}'" : "";
                    $html.=">";
                        foreach($errors as $key => $value){
                            if(is_array($value)){
                                $html .= "<li>{$value['message']}</li>";
                            }else{
                                $html .= "<li>{$value}</li>";
                            }
                        }
                    $html .="</ul>";
                $html .="</div>";
            }
            return $html;
        }
        public static function displayError($errors,$param){
            if(!empty($errors)){
                if(isset($errors[$param])){
                    return $errors[$param]['message'];
                }else{
                    return "";
                }
            }
        }
    }
?>