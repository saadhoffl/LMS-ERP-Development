<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";

class Skill{

    use SQLGetterSetter;

    private $conn;
    public $data;
    public $uid;
    public $username;
    public $table;
    public $row;

    public static function communication($first_name, $last_name, $date_of_birth){

        $conn = Database::getConnection("userdata");

        $uid = UserSession::$static_uid;
        $token = md5(random_int(0, 9999999990) . time());

        $sql = "INSERT INTO `personal` (`first_name`,`last_name`, `data_of_birth`)
        VALUES ('$first_name', '$last_name', '$date_of_birth')";
        
        $error = false;

        try {

            if ($conn->query($sql) === TRUE) {
                $error = false;
            } else {
                $error = $conn->error;
            }

        } catch (Exception $e) {
            $error = $conn->error;
        }
        
        return $error;
    }

    public function __construct(){

        $this->data = new GetSetDataHelper("personal", UserSession::$static_uid, true, "userdata");
        // $this->conn = Database::getConnection();
        // $this->username = $username;

        // $this->uid = null;
        // $this->table = 'auth';

        // $sql = "SELECT `uid` FROM `auth` WHERE `username`= '$username' OR `uid` = '$username' OR `email` = '$username' LIMIT 1";
        // $result = $this->conn->query($sql);

        // if ($result->num_rows) {

        //     $row = $result->fetch_assoc();
        //     $this->uid = $row['uid'];

        // } else {
        //     throw new Exception("Username does't exist");
        // }
    }

}