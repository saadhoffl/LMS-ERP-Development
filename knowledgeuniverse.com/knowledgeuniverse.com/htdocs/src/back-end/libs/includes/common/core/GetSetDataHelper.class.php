<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";

class GetSetDataHelper{

    use SQLGetterSetter;

    public $conn;
    public $id;
    public $uid;
    public $table;
 
    public function __construct($tableName, $var1, $bool1 = true, $server_name = null, $var2 = null, $bool2 = false, $var3 = null, $bool3 = false, $var4 = null, $bool4 = false){

        $this->uid = $var2;
        $this->table = $tableName;

        if($server_name == "userdata"){
            $this->conn = Database::getConnection_UserData();
        } else{
            $this->conn = Database::getConnection();
        }

        if($bool1 == true){
            $this->id = $var1;

        }elseif($bool2 == true){
            $this->id = $var2;

        }elseif($bool3 == true){
            $this->id = $var3;
            
        }elseif($bool4 == true){
            $this->id = $var4;
        }

    }

}