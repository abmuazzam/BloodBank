<?php
    namespace Application\Model;
    use Core\Helpers\Validation_Helper as Validation;
    use Core\Model;
    use Core\Session;

    class BloodRequests extends Model {
        static $_table = 'blood_requests',$_softDelete=true;
        public $fullName,$address,$purpose,$dated,$timing,$mobile,$bloodGroupId,$points,$deleted=0,$bloodGroup;
        const BlackList = ['deleted','bloodGroup'];
        function __construct(){
            parent::__construct();
        }
        public function validator(){
            $validate = new Validation();
            if($this->fullName!="" && $this->address!="" && $this->purpose!="" && $this->dated!="" && $this->timing!="" && $this->mobile!="" && $this->bloodGroupId!="" && $this->points!=""){
                if(Validation::string($this->fullName)){
                    if(Validation::text($this->address)){
                        if(Validation::text($this->purpose)){
                            if(Validation::date($this->dated)){
                                if(Validation::time($this->timing)){
                                    if(Validation::mobile($this->mobile)){
                                        if(Validation::is_int($this->bloodGroupId)){
                                            if(Validation::is_int($this->points)){
                                                return true;
                                            }else{
                                                Session::addMessage('alert alert-danger','Invalid Points!');
                                                return false;
                                            }
                                        }else{
                                            Session::addMessage('alert alert-danger','Invalid Blood Group!');
                                            return false;
                                        }
                                    }else{
                                        Session::addMessage('alert alert-danger','Invalid Mobile!');
                                        return false;
                                    }
                                }else{
                                    Session::addMessage('alert alert-danger','Invalid Time!');
                                    return false;
                                }
                            }else{
                                Session::addMessage('alert alert-danger','Invalid Date!');
                                return false;
                            }
                        }else{
                            Session::addMessage('alert alert-danger','Invalid Purpose!');
                            return false;
                        }
                    }else{
                        Session::addMessage('alert alert-danger','Invalid Address!');
                        return false;
                    }
                }else{
                    Session::addMessage('alert alert-danger','Invalid Full Name!');
                    return false;
                }
            }else{
                Session::addMessage('alert alert-danger','Fill All The Fields!');
                return false;
            }
        }

        public function beforeSave(){
           $this->timeStamps();
        }

        public function onConstruct(){
           $this->bloodGroup = BloodGroup::findById($this->bloodGroupId);
        }
    }