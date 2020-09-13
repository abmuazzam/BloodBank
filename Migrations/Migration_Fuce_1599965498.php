<?php
        namespace Migrations;
        use Core\Migration;
        class Migration_Fuce_1599965498 extends Migration{
            public function up(){
                $table = "contact_us";
                $this->createTable($table);
                $this->addColumn($table,'fullName','varchar',["size"=>100]);
                $this->addColumn($table,'mobile','varchar',["size"=>20]);
                $this->addColumn($table,'email','varchar',["size"=>100]);
                $this->addColumn($table,'subject','varchar',["size"=>100]);
                $this->addColumn($table,'message','text');
                $this->addColumn($table,'status','tinyint',["definition"=>"DEFAULT 0"]);
                $this->addSoftDelete($table);
                $this->addTimeStamps($table);
            }
        }
    ?>