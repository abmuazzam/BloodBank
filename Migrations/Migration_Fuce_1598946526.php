<?php
        namespace Migrations;
        use Core\Migration;
        class Migration_Fuce_1598946526 extends Migration{
            public function up(){
                $table = "migrations";
                $this->createTable($table);
                $this->addColumn($table,'migration','varchar',['size'=>100]);
            }
        }
    ?>