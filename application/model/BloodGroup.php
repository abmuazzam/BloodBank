<?php
    namespace Application\Model;
    use Core\Model;
    use Core\Helpers\Validation_Helper as Validation;

    class BloodGroup extends Model {
        static $_table="blood_groups",$_softDelete=true;
        public $bloodGroup,$deleted=0;
        const blackList = ['id','deleted'];
        function __construct(){
            parent::__construct();
        }
        public function validator(){
           $validate = new Validation();
                $validate->name(['bloodGroup',"Blood Group"])->value($this->bloodGroup)
                    ->customPattern('[A-Za-z+\- ]+')
                    ->min(1)->max(4)->required();
           return $validate;
        }
        public function beforeSave(){
            $this->timeStamps();
        }

        public function alreadyExists(){
            $blood = self::findFirst(
                [
                    "conditions"=>["bloodGroup=?","id!=?"],
                    "bind"=>[$this->bloodGroup,$this->id]
                ]
            );
            if($blood)
                return true;
            return false;
        }
    }