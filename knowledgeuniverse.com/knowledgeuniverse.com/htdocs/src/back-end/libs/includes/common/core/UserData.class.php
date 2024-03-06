<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";

class UserData{

    use SQLGetterSetter;

    private $conn;
    public $data;
    public $uid;
    public $username;
    public $table;
    public $row;

    public static function personal($first_name, $last_name, $date_of_birth){

        $conn = Database::getConnection_UserData();

        $uid = UserSession::$static_uid;

        $sql = "INSERT INTO `personal` (`uid`, `first_name`,`last_name`, `date_of_birth`, `is_completed`)
        VALUES ('$uid', '$first_name', '$last_name', '$date_of_birth', 'completed')";
        
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

    public static function contact($country_code, $phone_number, $whatsapp_number, $telegram_username, $contact_email){

        $conn = Database::getConnection_UserData();

        $uid = UserSession::$static_uid;

        $sql = "INSERT INTO `contact` (`uid`, `country_code`,`phone_number`, `whatsapp_number`, `telegram_username`,`contact_email`, `is_completed`)
        VALUES ('$uid', '$country_code', '$phone_number', '$whatsapp_number', '$telegram_username', '$contact_email', 'completed')";
        
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

    public static function education($education_level, $name_of_school_college, $location_of_school_college, $year_of_passing){

        $conn = Database::getConnection_UserData();

        $uid = UserSession::$static_uid;

        $sql = "INSERT INTO `education` (`uid`, `education_level`, `name_of_school_college`, `location_of_school_college`, `year_of_passing`, `is_completed`)
        VALUES ('$uid', '$education_level', '$name_of_school_college', '$location_of_school_college', '$year_of_passing', 'completed')";
        
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

    public static function career($occupation, $company_name, $working_domain, $working_experience, $current_package){

        $conn = Database::getConnection_UserData();

        $uid = UserSession::$static_uid;

        $sql = "INSERT INTO `career` (`uid`, `occupation`, `company_name`, `working_domain`, `working_experience`, `current_package`, `is_completed`)
        VALUES ('$uid', '$occupation', '$company_name', '$working_domain', '$working_experience', '$current_package', 'completed')";
        
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

    public static function address($house_no_name, $area_colony, $state, $city, $pincode){

        $conn = Database::getConnection_UserData();

        $uid = UserSession::$static_uid;

        $sql = "INSERT INTO `address` (`uid`, `house_no_name`,`area_colony`, `state`, `city`, `pincode`, `is_completed`)
        VALUES ('$uid', '$house_no_name', '$area_colony', '$state', '$city', '$pincode', 'completed')";
        
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

    public static function id_verification($id_proof, $id_number, $id_saved_path){

        $conn = Database::getConnection_UserData();

        $uid = UserSession::$static_uid;

        $sql = "INSERT INTO `id_proof` (`uid`, `id_proof`,`id_number`, `id_saved_path`, `is_completed`)
        VALUES ('$uid', '$id_proof', '$id_number', '$id_saved_path', 'completed')";
        
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

    public static function is_personal_details_completed(){
        $data = new GetSetDataHelper("personal", UserSession::$static_uid, true, "userdata");
        if($data->getIsCompleted()){
            return true;
        } else{
            return false;
        }
    }

    public static function is_contact_details_completed(){
        $data = new GetSetDataHelper("contact", UserSession::$static_uid, true, "userdata");
        if($data->getIsCompleted()){
            return true;
        } else{
            return false;
        }
    }

    public static function is_education_details_completed(){
        $data = new GetSetDataHelper("education", UserSession::$static_uid, true, "userdata");
        if($data->getIsCompleted()){
            return true;
        } else{
            return false;
        }
    }

    public static function is_career_details_completed(){
        $data = new GetSetDataHelper("career", UserSession::$static_uid, true, "userdata");
        if($data->getIsCompleted()){
            return true;
        } else{
            return false;
        }
    }

    public static function is_address_details_completed(){
        $data = new GetSetDataHelper("address", UserSession::$static_uid, true, "userdata");
        if($data->getIsCompleted()){
            return true;
        } else{
            return false;
        }
    }

    public static function is_id_proof_completed(){
        $data = new GetSetDataHelper("id_proof", UserSession::$static_uid, true, "userdata");
        if($data->getIsCompleted()){
            return true;
        } else{
            return false;
        }
    }

    public function __construct(){

        $this->data = new GetSetDataHelper("personal", UserSession::$static_uid, true, "userdata");
        
    }

}