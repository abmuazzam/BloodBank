<?php
    namespace Application\Model;
    use Core\Model;
    use Core\Helpers\Validation_Helper as Validation;
    class Donors extends Model{
        static $_table = "donors",$_softDelete = true;
        public $fullName,$mobile,$email,$age,$gender,$bloodGroupId,$address,$pincode,$message,$bloodGroup,$deleted=0;
        const blackList = ['deleted','bloodGroup'];
        function __construct(){
            parent::__construct();
        }
        public function validator(){
           $validate = new Validation();
            $validate->name(['fullName','Donor Name'])->value($this->fullName)
                ->pattern('words')
                ->min(4)->max(50)->required();
            $validate->name('mobile')->value($this->mobile)
                ->pattern('tel')
                ->min(10)->max(16)->required();
            $validate->name('email')->value($this->email)
                ->pattern('email')
                ->max(100)->required();
            $validate->name('age')->value($this->age)
                ->pattern('int')->min(2)->max(3)
                ->required();
            $validate->name('gender')->value($this->gender)
                ->pattern('alpha')->required();
            $validate->name(['bloodGroupId','Blood Group'])->value($this->bloodGroupId)
                ->pattern('int')
                ->min(1)->max(1)
                ->required();
            $validate->name(['pincode','Pin Code'])->value($this->pincode)
                ->pattern('int')
                ->min(6)->max(6)
                ->required();
            $validate->name('address')->value($this->address)
                ->pattern('text')
                ->min(10)->max(200)
                ->required();
            if($this->message!=""){
                $validate->name('message')->value($this->message)
                    ->pattern('text')
                    ->min(10)->required();
            }
           return $validate;
        }
        public function alreadyExists(){
            $donor = self::findFirst(["conditions"=>["(email=? OR mobile=?)","id!=?"],"bind"=>[$this->email,$this->mobile,$this->id]]);
            if($donor){
                return true;
            }else{
            return false;
            }
        }
        public function beforeSave()
        {
           $this->timeStamps();
        }

        public function onConstruct(){
            $this->bloodGroup = BloodGroup::findById($this->bloodGroupId);
        }
    }