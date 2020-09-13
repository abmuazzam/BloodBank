<?php
        namespace Migrations;
        use Core\Migration;
        class Migration_Fuce_1599918710 extends Migration{
            public function up(){
                $table = "blood_requests";
                $this->createTable($table);
                $this->addColumn($table,'fullName','varchar',["size"=>100]);
                $this->addColumn($table,'address','text');
                $this->addColumn($table,'purpose','text');
                $this->addColumn($table,'dated','date');
                $this->addColumn($table,'timing','time');
                $this->addColumn($table,'mobile','varchar',["size"=>20]);
                $this->addColumn($table,'bloodGroupId','int');
                $this->addColumn($table,'points','int');
                $this->addSoftDelete($table);
                $this->addTimeStamps($table);
                $this->addForeignKey($table,'blood_groups','bloodGroupId','id','bg_request');
            }
        }
    ?>