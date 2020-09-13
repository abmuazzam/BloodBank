<?php
    namespace Application\Model;
    use Core\Model;
    use Core\Helpers\Validation_Helper as Validation;
    use Core\Session as Session;
    use Core\Helpers\Encryption_Helper as EH;
    use Core\Router;
    class Users extends Model{
        protected static $_table = "users",$_softDelete = true;
        public $username,$password,$email,$mobile;

        function __construct(){
            parent::__construct();
        }

        public function validator(){
            $validate = new Validation();
            $validate->name('username')
                ->value($this->username)
                ->customPattern('[A-Za-z0-9_]+')
                ->min(4)
                ->max(10)
                ->required();
            $validate->name('password')->value($this->password)
                ->customPattern('[A-Za-z0-9_.#@]+')
                ->min(6)->max(10)
                ->required();
            return $validate;
        }
        public function login(){
            $user = self::findFirst(["conditions"=>["username=?"],"bind"=>[$this->username]]);
            if($user){
                if(EH::verify($this->password,$user->password)){
                    Session::set(ADMIN_SESSION,$user);
                    $status = true;
                }else{
                    Session::addMessage('alert alert-danger','Invalid Credentials!');
                    $status = false;
                }
            }else{
                Session::addMessage('alert alert-danger','Invalid Credentials!');
                $status = false;
            }
            return $status;
        }
        public function isLoggedIn(){
            return (Session::exists(ADMIN_SESSION));
        }
        public static function getLoggedInUser(){
            return Session::get(ADMIN_SESSION);
        }
        public static function hasAccess($role){
            if($role == ADMIN){
                if(!Session::exists(ADMIN_SESSION))
                    die("You are not authorized");
            }else if($role = USER){
                if(!Session::exists(USER_SESSION))
                    die("You are not authorized");
            }
        }
        public static function isAuthorized($role){
            if($role == ADMIN){
                if(!Session::exists(ADMIN_SESSION)){
                    Router::redirect('Admin');
                }
            }else if($role = USER){
                if(!Session::exists(USER_SESSION)){

                }

            }
        }
    }