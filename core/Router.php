<?php
    namespace Core;
    use Application\Controller\ErrorController;
    class Router{
        public static function route(){
            $url = (isset($_GET['url'])) ? $_GET['url'] : '';
            $url = rtrim($url,"/");
            $url = explode("/",$url);
            $eController = new ErrorController();

            $ctrl = (!empty($url[0])) ? $url[0]."Controller" : DEFAULT_CONTROLLER."Controller";
            $ctrl = "Application\Controller\\".$ctrl;
            if(class_exists($ctrl)){
                $controller = new $ctrl;
                $action = strtolower((!empty($url[1]) ? $url[1] : DEFAULT_ACTION));
                $param = (!empty($url[2]) || isset($url[2])) ? $url[2] : '';
                if(method_exists($controller,$action)){
                    $controller->{$action}($param);
                }else{
                    $eController->index();
                }
            }else{
                $eController->index();
            }
        }
        public static function redirect($path){
            if(!headers_sent()){
                header('Location:'.WEBPATH.$path);
            }else{
?>
                <script type="text/javascript">
                    window.location.href = "<?= WEBPATH.$path?>";
                </script>
                <noscript>
                    <meta http-equiv="refresh" content="0;url=<?= WEBPATH.$path;?>"/>
                </noscript>
<?php
            }
        }
    }
?>
