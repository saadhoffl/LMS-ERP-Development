<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";

class GetSetDataHelper{

    use SQLGetterSetter;

    public $conn;
    public $id;
    public $uid;
    public $table;
 
    public function __construct($tableName, $var1, $bool1 = true, $var2 = null, $bool2 = false, $var3 = null, $bool3 = false, $var4 = null, $bool4 = false){

        $this->conn = Database::getConnection();
        $this->uid = $var2;
        $this->table = $tableName;

            if($bool1 == true){
                $this->id = $var1;
                print("var1: ");

            }elseif($bool2 == true){
                $this->id = $var2;
                print("var2: ");

            }elseif($bool3 == true){
                $this->id = $var3;
                print("var3: ");
                
            }elseif($bool4 == true){
                $this->id = $var4;
                print("var4:  ");
            }

            print($this->id);

    }

}