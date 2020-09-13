<?php
    namespace Application\Controller;
    use Application\Model\BloodGroup;
    use Application\Model\BloodRequests;
    use Core\Controller;
    use Application\Model\Users;
    use Core\Helpers\Encryption_Helper;
    use Core\Helpers\Request_Helper as Request;
    use Core\Session as Session;
    use Core\Router;
    use Core\Helpers\Encryption_Helper as EH;

    class BloodController extends Controller {
        function __construct(){
            parent::__construct();
            Users::isAuthorized(ADMIN);
            Users::hasAccess(ADMIN);
            $this->request = new Request();
            $this->bloodGroup = new BloodGroup();
        }
        public function index(){
            $bloods = BloodGroup::find(["order"=>"id DESC"]);
            $this->view->render('blood/index','All Blood Groups',["bloodGroups"=>$bloods]);
        }
        public function create(){
            if($this->request->isPost()){
                $this->bloodGroup->assign($this->request->get(),BloodGroup::blackList);
                if($this->bloodGroup->validator()->isSuccess()){
                    if(!$this->bloodGroup->alreadyExists()){
                        if($this->bloodGroup->save()){
                            Session::addMessage('alert alert-success','Blood Group Created Successfully!');
                            Router::redirect('Blood');
                            exit;
                        }else{
                            Session::addMessage('alert alert-danger','Something Went Wrong!');
                        }
                    }else{
                        Session::addMessage('alert alert-danger','Blood Group Already Exists!');
                    }
                }else{
                    $errors = $this->bloodGroup->validator()->errors;
                }
            }else{
                $errors = [];
            }
            $this->view->render('blood/create','Add Blood Group',["model"=>$this->bloodGroup,"errors"=>$errors]);
        }
        public function edit($id){
            $id = EH::decrypt($id);
            $blood = BloodGroup::findById($id);
            if(!$blood){
                Session::addMessage('alert alert-danger','Blood Group Not Found');
                Router::redirect('Blood');
                exit;
            }
            if($this->request->isPost()){
                $this->bloodGroup->id = $this->request->get('id');
                $this->bloodGroup->assign($this->request->get(),BloodGroup::blackList);
                if($this->bloodGroup->validator()->isSuccess()){
                    if($this->bloodGroup->save()){
                        Session::addMessage('alert alert-success','Blood Group Updated Successfully!');
                        Router::redirect('Blood');
                        exit;
                    }else{
                        Session::addMessage('alert alert-danger','Something Went Wrong!');
                    }
                }else{
                    $errors = $this->bloodGroup->validator()->errors;
                }
            }else{
                $errors = [];
            }
            $this->view->render('blood/edit','Edit Blood Group',["model"=>$blood,"errors"=>$errors]);
        }
        public function delete($id){
            $id = EH::decrypt($id);
            $bg = BloodGroup::findById($id);
            if($bg){
                $this->bloodGroup->id = $id;
                if($this->bloodGroup->delete()){
                    Session::addMessage('alert alert-success','Blood Group Deleted!');
                    Router::redirect('Blood');
                }
            }

        }
        public function request(){
            $requests = BloodRequests::find(
                [
                    "columns" => "blood_requests.*, bg.bloodGroup",
                    "joins" =>  [
                        [
                            "blood_groups",
                            "blood_requests.bloodGroupId = bg.id",
                            "bg"
                        ]
                    ],
                    "order" => "blood_requests.id DESC"
                ]
            );
            $this->view->render('blood/request','All Requests',["requests"=>$requests]);
        }
    }
?>