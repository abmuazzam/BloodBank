<?php
    namespace Core;
    use Core\Database;
    abstract class Migration{
        protected $_db,$_isCli;
        protected $_columnTypesMap = [
          'int'         => 'intColumn',
          'integer'     => 'intColumn',
          'tinyint'     =>  'tinyintColumn',
          'smallint'    =>  'smallintColumn',
          'mediumint'   =>  'mediumintColumn',
          'bigint'      =>  'bigintColumn',
          'numeric'     =>  'decimalColumn',
          'decimal'     =>  'decimalColumn',
          'double'      =>  'doubleColumn',
          'float'       =>  'floatColumn',
          'bit'         =>  'bitColumn',
          'date'        =>  'dateColumn',
          'datetime'    =>  'datetimeColumn',
          'timestamp'   =>  'timestampColumn',
          'time'        =>  'timeColumn',
          'year'        =>  'yearColumn',
          'char'        =>  'charColumn',
          'varchar'     =>  'varcharColumn',
          'text'        =>  'textColumn',
          'mediumtext'  =>  'mediumtextColumn',
          'longtext'    =>  'longtextColumn'
        ];
        public function __construct($isCli){
            $this->_db = Database::connect();
            $this->_isCli = $isCli;
        }
        abstract function up();
        public function createTable($table){
            $sql = "CREATE TABLE IF NOT EXISTS {$table}(
                         id INT PRIMARY KEY AUTO_INCREMENT  
                    )";
            $res = !$this->_db->query($sql)->error();
            $this->printColor($res,"Creating Table ".$table);
            return $res;
        }
        public function dropTable($table){
            $sql  = "DROP TABLE IF EXISTS {$table}";
            $msg = "Dropping table {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function addColumn($table,$column,$type,$attrs = []){
            $formattedType = call_user_func([$this,$this->_columnTypesMap[$type]],$attrs);
            $definition = array_key_exists('definition',$attrs) ? $attrs['definition']." " : "";
            $order = $this->orderingColumn($attrs);
            $sql = "ALTER TABLE {$table} ADD COLUMN {$column} {$formattedType} {$definition} {$order};";
            $msg = "Adding Column {$column} To {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function addEnum($table,$column,$attrs = []){
            if(array_key_exists('enum',$attrs)){
                $define = "'".implode("','", $attrs['enum'])."'";
            }
            $order = $this->orderingColumn($attrs);
            $sql = "ALTER TABLE {$table} ADD COLUMN {$column} ENUM({$define}) {$order};";
            $msg = "Adding Column {$column} To {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function dropColumn($table,$column){
            $sql = "ALTER TABLE {$table} DROP COLUMN {$column};";
            $msg = "Dropping Column {$column} From {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function addTimeStamps($table){
            $c = $this->addColumn($table,'created_at','timestamp');
            $u = $this->addColumn($table,'updated_at','timestamp');
            return $c && $u;
        }
        public function addIndex($table,$name,$columns = false){
            $columns = (!$columns) ? $name : $columns;
            $sql = "ALTER TABLE {$table} ADD INDEX {$name} ({$columns});";
            $msg = "Adding Index {$name} To {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function dropIndex($table,$name){
            $sql = "DROP INDEX {$name} ON {$table};";
            $msg = "Dropping Index {$name} From {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function addSoftDelete($table){
            $this->addColumn($table,'deleted','tinyint');
            $this->addIndex($table,'deleted');
        }
        public function addForeignKey($table,$from,$column,$fromId,$constraint){
            $sql = " ALTER TABLE {$table} ADD CONSTRAINT FK_{$constraint} FOREIGN KEY ({$column}) REFERENCES {$from}({$fromId});";
            $msg = "Adding Foreign Key {$constraint} To {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function dropForeignKey($table,$constraint){
            $sql = "ALTER TABLE {$table} DROP FOREIGN KEY FK_{$constraint};";
            $msg = "Dropping Foreign Key {$constraint} To {$table}";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        public function query($sql){
            $msg = "Running Query:\"".$sql."\"";
            $resp = !$this->_db->query($sql)->error();
            $this->printColor($resp,$msg);
            return $resp;
        }
        protected function intColumn($attrs){
            return "INT";
        }
        protected function tinyintColumn($attrs){
            return "TINYINT";
        }
        protected function smallintColumn($attrs){
            return "SMALLINT";
        }
        protected function mediumintColumn($attrs){
            return "MEDIUMINT";
        }
        protected function bigintColumn($attrs){
            return "BIGINT";
        }
        protected function decimalColumn($attrs){
            $params = $this->parsePrecisionScale($attrs);
            return "DECIMAL".$params;
        }
        protected function floatColumn($attrs){
            $params = $this->parsePrecisionScale($attrs);
            return "FLOAT".$params;
        }
        protected function doubleColumn($attrs){
            return "BIT(".$attrs['size'].")";
        }
        protected function bitColumn($attrs){
            $params = $this->parsePrecisionScale($attrs);
            return "DECIMAL".$params;
        }
        protected function dateColumn($attrs){
            return "DATE";
        }
        protected function datetimeColumn($attrs){
            return "DATETIME";
        }
        protected function timestampColumn($attrs){
            return "TIMESTAMP";
        }
        protected function timeColumn($attrs){
            return "TIME";
        }
        protected function yearColumn($attrs){
            return "YEAR(4)";
        }
        protected function charColumn($attrs){
            $params = $this->parsePrecisionScale($attrs);
            return "CHAR".$params;
        }
        protected function varcharColumn($attrs){
            $params = $this->parsePrecisionScale($attrs);
            return "VARCHAR".$params;
        }
        protected function textColumn($attrs){
            return "TEXT";
        }
        protected function mediumtextColumn($attrs){
            return "MEDIUMTEXT";
        }
        protected function longtextColumn($attrs){
            return "LONGTEXT";
        }

        protected function parsePrecisionScale($attrs){
            $precision = (array_key_exists('precision',$attrs)) ? $attrs['precision'] : null;
            $precision = (!$precision && array_key_exists('size',$attrs)) ? $attrs['size'] : $precision;
            $scale = (array_key_exists('scale',$attrs)) ? $attrs['scale'] : null;
            $params = ($precision) ? "(".$precision : "";
            $params .= ($precision && $scale) ? ", ".$scale : "";
            $params .= ($precision) ? ")" : "";
            return $params;
        }
        protected function orderingColumn($attrs){
            if(array_key_exists('after',$attrs)){
                return " AFTER ".$attrs['after'];
            }else if(array_key_exists('before',$attrs)){
                return " BEFORE ".$attrs['before'];
            }else{
                return "";
            }
        }
        protected function printColor($res,$message){
            $title = ($res) ? " SUCCESS " : " FAIL ";
            if($this->_isCli){
                $for = ($res) ? "\e[0;30;" : "\e[0;30;";
                $back = ($res) ? "42m" : "41m";
                echo $for.$back."\n\n"." ".$title.$message."\n\e[0m\n";
            }else{
                $color = ($res) ? "#006600" : "#cc0000";
                echo "<p style='color: ".$color."'>".$title.$message."</p>";
            }
        }
    }