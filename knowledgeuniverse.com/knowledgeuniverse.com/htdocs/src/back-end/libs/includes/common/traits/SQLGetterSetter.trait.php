<?php

trait SQLGetterSetter{

    public function __call($name, $arguments){

        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        
        if (substr($name, 0, 3) == "get") {
            return $this->_getter($property);

        } elseif (substr($name, 0, 3) == "set") {
            return $this->_setter($property, $arguments[0]);

        } else {
            throw new Exception(__CLASS__."::__call() -> $name, function unavailable.");
        }
    }

    private function _getter($var){

        if($this->table == 'session'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id' OR `id` = '$this->id' OR `refresh_token` = '$this->id' OR `client_id` = '$this->id'";
        
        }elseif($this->table == 'auth'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id' OR `id` = '$this->id'";
        
        }elseif($this->table == 'personal'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id'";

        }elseif($this->table == 'contact'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id'";

        }elseif($this->table == 'address'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id'";    

        }elseif($this->table == 'education'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id'";

        }elseif($this->table == 'career'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id'";

        }elseif($this->table == 'id_proof'){
            $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id'";
        }

        // if ($this->conn) {
        //     $this->conn = Database::getConnection();
        // }

        try {

            $result = $this->conn->query($sql);
            
            if ($result and $result->num_rows >= 1) {

                return $result->fetch_assoc()["$var"];
                return null;
                
            }            

        } catch (Exception $e) {
            throw new Exception(__CLASS__."::_getter() -> $var, data unavailable.");
        }
    }

    private function _setter($var, $data){

        // if (!$this->conn) {
        //     $this->conn = Database::getConnection();
        // }

        try {
            print("SQL SETTER: ".$this->uid);
            $sql = "UPDATE `$this->table` SET `$var`='$data' WHERE `uid`='$this->uid'";

            if ($this->conn->query($sql)) {
                return true;

            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new Exception(__CLASS__."::_setter() -> $var, data unavailable.");
        }
    }

}