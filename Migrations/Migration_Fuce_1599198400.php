<?php
        namespace Migrations;
        use Core\Migration;
        class Migration_Fuce_1599198400 extends Migration{
            public function up(){
                $table = "blood_groups";
                $this->createTable($table);
                $this->addColumn($table,'bloodGroup','varchar',['size'=>'10']);
                $this->addSoftDelete($table);
                $this->addTimeStamps($table);
            }
        }
    ?>