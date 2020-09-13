<?php
    namespace Application\Controller;
    use Application\Model\BloodGroup;
    use Application\Model\BloodRequests;
    use Application\Model\ContactUs;
    use Application\Model\Donors;
    use Core\Controller as Controller;
    use Core\Helpers\Request_Helper as Request;
    use Core\Helpers\Validation_Helper as Validation;
    use Application\Model\Users as Users;
    use Core\Router;
    use Core\Session;

    class HomeController extends Controller {
        private $validate;
        function __construct(){
            parent::__construct();
            $this->validate = new Validation();
            $this->request = new Request();
            $this->donor = new Donors();
            $bloodGroups = BloodGroup::find();
            $this->bgs = array();
            foreach($bloodGroups as $bg){
                $this->bgs[$bg->id] = $bg->bloodGroup;
            }
            $this->view->setLayout('main_layout');
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
                    "order" => "rand()",
                    "limit"=>'5'
                ]
            );
            $this->view->render('home\index',"Home",["donors"=>$donors]);
        }
        public function whytobedonor(){
            $this->view->render('home\why_be_donor',"Why To Become Donor?");
        }
        public function becomedonor(){
            $donor = new Donors();
            if($this->request->isPost()){
                $this->donor->assign($this->request->get(),Donors::blackList);
                if($this->donor->validator()->isSuccess()){
                    if(!$this->donor->alreadyExists()){
                        if($this->donor->save()){
                            Session::addMessage('alert alert-success','Donor Added Successfully!');
                            Router::redirect('Home/SearchDonor');
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
            $this->view->render('home\becomeDonor',"Become Donor?",
                [
                "model"=>$this->donor,
                "errors"=>$errors,
                "bloodGroups" => $this->bgs
                ]
            );
        }
        public function searchdonor(){
            $errors = [];
            if($this->request->isPost()){
                if(!empty($this->request->get('bloodGroupId')) && !empty($this->request->get('pincode')) ){
                    $conditions = array("donors.bloodGroupId = ?","donors.pincode = ?");
                    $bind = array($this->request->get('bloodGroupId'),$this->request->get('pincode'));
                }else if(!empty($this->request->get('bloodGroupId'))){
                    $conditions = array("donors.bloodGroupId = ?");
                    $bind = array($this->request->get('bloodGroupId'));
                }else if(!empty($this->request->get('pincode'))){
                    $conditions = array("donors.pincode = ?");
                    $bind = array($this->request->get('pincode'));
                }else{
                    $conditions = array();$bind=array();
                }
                $donors = Donors::find(
                    [
                        "conditions" => $conditions,
                        "bind"      => $bind,
                        "columns"=>"donors.*,bg.bloodGroup",
                        "joins"=>[
                            [
                                "blood_groups",
                                "donors.bloodGroupId = bg.id",
                                "bg"
                            ]
                        ],
                        "order" => "id DESC"
                    ]
                );
            }else{
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
                        "order" => "id DESC"
                    ]
                );
            }
            $this->view->render('home\searchDonor',"Become Donor?",
                [
                    "donors"=>$donors,
                    "bloodGroups" => $this->bgs,
                    "errors"=>$errors
                ]
            );
        }
        public function contactus(){
            $errors = [];$contact = new ContactUs();
            if($this->request->isPost()){
                $contact->assign($this->request->get(),ContactUs::BlackList);
                if($contact->validator()->isSuccess()){
                    $saved = $contact->save();
                    if($saved){
                        Session::addMessage('alert alert-success','Your query has sent! Will get back to you soon.');
                        Router::redirect('Home/ContactUs');
                        exit;
                    }else{
                        Session::addMessage('alert alert-danger','Something Went Wrong!');
                    }
                }else{
                    $errors = $contact->validator()->errors;
                }
            }
            $this->view->render('home\contact','Contact Us',
                [
                    "model" => $contact,
                    "errors"=>$errors
                ]
            );
        }
        public function request_blood(){
            $model = new BloodRequests();
            if($this->request->isPost()){
                $model->assign($this->request->get(),BloodRequests::BlackList);
                if($model->validator()){
                    $saved = $model->save();
                    if($saved){
                        echo "1";
                    }else{
                        Session::addMessage('alert alert-danger','Something Went Wrong!');
                        echo Session::getMessage();
                    }
                }else{
                    echo Session::getMessage();
                }
            }else{
                die("Not Accessible");
            }
        }
    }
?>