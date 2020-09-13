<?php
    namespace Application\Model;
    use Core\Model;
    use Core\Helpers\Validation_Helper as Validation;
    class ContactUs extends Model{
        static $_table = "contact_us",$_softDelete = false;
        public $fullName,$mobile,$email,$subject,$message,$deleted=0,$status=0;
        const BlackList = ['deleted'];
        function __construct(){
            parent::__construct();
        }
        public function validator(){
            $validate = new Validation();
            $validate->name(['fullName','Full Name'])->value($this->fullName)
                ->min(3)->max(50)->pattern('words')
                ->required();
            $validate->name('mobile')->value($this->mobile)
                ->min(10)->max(20)->pattern('tel')
                ->required();
            $validate->name('email')->value($this->email)
                ->min(10)->max(100)
                ->pattern('email')->required();
            $validate->name('subject')->value($this->subject)
                ->min(4)->max(50)
                ->pattern('words')->required();
            $validate->name('message')->value($this->message)
                ->min(10)
                ->pattern('words')
                ->required();
            return $validate;
        }
        public function beforeSave(){
            $this->timeStamps();
        }
    }