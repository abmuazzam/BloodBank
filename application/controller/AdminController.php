<?php
    namespace Application\Controller;
    use Application\Model\ContactUs;
    use Application\Model\Users;
    use Core\Controller;
    use Core\Helpers\Encryption_Helper as EH;
    use Core\Session;
    use Core\Helpers\Request_Helper as Request;
    use Core\Router as Router;

    class AdminController extends Controller {
        function __construct(){
            parent::__construct();
            $this->users = new Users();
        }
        public function index(){
            $errors = [];
            if(!$this->users->isLoggedIn()){
                $this->view->setLayout('layout_no_include');
                $this->view->render('admin/login','Login',['user'=>$this->users,'errors'=>$errors]);
            }else{
                Users::isAuthorized(ADMIN);
                $this->view->render('admin/index','Dashboard');
            }
        }
        public function login(){
           $this->view->setLayout('layout_no_include');
           $request = new Request();
           if($request->isPost()){
               $this->users->assign($_POST);
               if($this->users->validator()->isSuccess()){
                    if($this->users->login()){
                        Router::redirect('Admin');
                        exit;
                    }
               }
               $errors = $this->users->validator()->errors;
           }else{
               $errors = [];
           }
            $this->view->render('admin/login','Login',['user'=>$this->users,'errors'=>$errors]);
        }
        public function logout(){
            Session::end();
            Router::redirect('Admin');
        }
        public function contact(){
            Users::isAuthorized(ADMIN);Users::hasAccess(ADMIN);
            $contacts = ContactUs::find(["order"=>"id DESC"]);
            $this->view->render('admin/contact','All Contacts',
                [
                    "contacts"  => $contacts
                ]
            );
        }
        public function viewcontact($id){
            $contact = ContactUs::findById(EH::decrypt($id));
            if($contact){

                $this->view->render('admin/view_contact','View Contact',["model"=>$contact]);
            }else{
                Router::redirect('Admin/Contact');
            }
        }
        public function updatecontact($id){
            $contact = new ContactUs();
            $contact->id = EH::decrypt($id);
            $contact->status = 1;
            $updated = $contact->update(["status"=>"1"]);
            if($updated){
                Session::addMessage('alert alert-success','Updated Successfully!');
            }else{
                Session::addMessage('alert alert-danger','Error While Updating!');
            }
            Router::redirect('Admin/Contact');
            exit;
        }

    }