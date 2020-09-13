<?php
namespace Core\Helpers;
use Core\Helpers\Form_Helper as FH;
    class Html_Helper{
        public static function link($rel,$href,$type='text/css',$extra = []){
            if($type=="text/css"){
                $href = $href.'.css';
                $href = "public/".$href;
            }else{
                $href = "public/".$href;
            }
            return "\t <link rel=\"{$rel}\" type=\"{$type}\" href=\"{$href}\" ".FH::stringfy($extra)."/> \t\n";
        }
        public static function script($source,$content = ''){
            if(!$content && $source){
                $script = "\t <script type=\"text/javascript\" src=\"public/{$source}.js\"></script> \t\n";
            }else{
                $script = "\t <script type='text/javascript'> \n";
                    $script.="\t\n".$content."\t\n";
                $script.="\t </script>\n";
            }
            return $script;
        }
        public static function meta_keywords($keywords = []){
            $keyword="\t <meta name=\"keywords\" content=\"".implode(',',$keywords)."\" /> \t\n";
            return $keyword;
        }
        public static function meta_description($description=''){
            if($description){
                return "<meta name=\"description\" content=\"{$description}\"/> \t\n";
            }
        }
    }
?>