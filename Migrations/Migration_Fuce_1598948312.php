<?php
        namespace Migrations;
        use Core\Migration;
        class Migration_Fuce_1598948312 extends Migration{
            public function up(){
                $table = 'users';
                $this->createTable($table);
                $this->addTimeStamps($table);
                $this->addColumn($table,'username','varchar',['size'=>30,'after'=>'id']);
                $this->addColumn($table,'password','varchar',['size'=>300,'after'=>'username']);
                $this->addColumn($table,'email','varchar',['size'=>100,'after'=>'password']);
                $this->addColumn($table,'mobile','varchar',['size'=>20,'after'=>'email']);
                $this->addSoftDelete($table);
                $this->addIndex($table,'created_at');
                $this->addIndex($table,'updated_at');
            }
        }
    ?>