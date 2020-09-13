<?php
    namespace Application\Controller;
    use Application\Model\BloodGroup;
    use Application\Model\Donors;
    use Core\Controller;
    use Core\Helpers\Request_Helper as Request;
    use Application\Model\Users;
    use Core\Session;
    use Core\Router;
    use Core\Helpers\Encryption_Helper as EH;

    class DonorController extends Controller {
        function __construct(){
            parent::__construct();
            Users::isAuthorized(ADMIN);
            Users::hasAccess(ADMIN);
            $this->request = new Request();
            $this->donor = new Donors();
            $bloodGroups = BloodGroup::find();
            $this->bgs = array();
            foreach($bloodGroups as $bg){
                $this->bgs[$bg->id] = $bg->bloodGroup;
            }
        }
        public function index(){
            $donors = Donors::find(
                [
                    "columns"=>"donors.*,bg.bloodGroup",
                    "joins"=>[
                        [
                            "blood_groups",
                            "donors.bloodGroupId = bg.id",
                            "bg"
                        ]
                    ],
                    "order" => "donors.id DESC"
                ]
            );
            $this->view->render('donor/index','All Donors',["donors"=>$donors]);
        }
        public function create(){
            if($this->request->isPost()){
                $this->donor->assign($this->request->get(),Donors::blackList);
                if($this->donor->validator()->isSuccess()){
                   if(!$this->donor->alreadyExists()){
                       if($this->donor->save()){
                           Session::addMessage('alert alert-success','Donor Added Successfully!');
                           Router::redirect('Donor');
                           exit;
                       }else{
                           Session::addMessage('alert alert-danger','Something Went Wrong!');
                       }
                   }else{
                       Session::addMessage('alert alert-danger','Donor Already Exists!');
                   }
                }else{
                    $errors = $this->donor->validator()->errors;
                }
            }else{
                $errors = [];
            }
            $this->view->render('donor/create','Add Donor',
                [
                    "model"=>$this->donor,
                    "errors"=>$errors,
                    "bloodGroups" => $this->bgs
                ]
            );
        }
        public function edit($id){
            $model = Donors::findById(EH::decrypt($id));
            if($this->request->isPost()){
                $this->donor->assign($this->request->get(),Donors::blackList);
                if($this->donor->validator()->isSuccess()){
                    if(!$this->donor->alreadyExists()){
                        if($this->donor->save()){
                            Session::addMessage('alert alert-success','Donor Updated Successfully!');
                            Router::redirect('Donor');
                            exit;
                        }else{
                            Session::addMessage('alert alert-danger','Something Went Wrong!');
                        }
                    }else{
                        Session::addMessage('alert alert-danger','Donor Already Exists!');
                    }
                }else{
                    $errors = $this->donor->validator()->errors;
                }
            }else{
                $errors = [];
            }
            $this->view->render('donor/edit','Edit',
                [
                    'model'=>$model,
                    "bloodGroups" => $this->bgs,
                    "errors"=>$errors
                ]
            );
        }
        public function view($id){
            $model = Donors::findFirst(
                [
                    "columns"=>"donors.*,bg.bloodGroup",
                    "joins"=>[
                        [
                            "blood_groups",
                            "donors.bloodGroupId = bg.id",
                            "bg"
                        ]
                    ],
                    "order" => "donors.id DESC"
                ]
            );
            $this->view->render('donor/view','View Details',["donor"=>$model]);
        }
        public function delete($id){
            $donor = Donors::findById(EH::decrypt($id));
            if($donor){
                $this->donor->assign($donor);
                if($this->donor->delete()){
                    Session::addMessage('alert alert-success','Donor Deleted Successfully!');
                    Router::redirect('Donor/');
                    exit;
                }
            }else{
                Session::addMessage('alert alert-danger','Donor Not Found!');
                Router::redirect('Donor/');
            }
        }
    }