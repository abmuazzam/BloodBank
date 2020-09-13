<?php
        namespace Migrations;
        use Core\Migration;
        class Migration_Fuce_1599204614 extends Migration{
            public function up(){
                $table = "donors";
                $this->createTable($table);
                $this->addColumn($table,'fullName','varchar',['size'=>100]);
                $this->addColumn($table,'mobile','varchar',['size'=>20]);
                $this->addColumn($table,'email','varchar',['size'=>200]);
                $this->addColumn($table,'age','int');
                $this->addEnum($table,'gender',["enum"=>["male","female","transgender"]]);
                $this->addColumn($table,'bloodGroupId','int');
                $this->addColumn($table,'address','longtext');
                $this->addColumn($table,'pincode','int');
                $this->addColumn($table,'message','longtext');
                $this->addForeignKey($table,'blood_groups','bloodGroupId','id','blood_group');
                $this->addSoftDelete($table);
                $this->addTimeStamps($table);
            }
        }
    ?>