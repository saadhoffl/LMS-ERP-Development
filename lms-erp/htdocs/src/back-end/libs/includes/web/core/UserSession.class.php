<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";

class UserSession{

    use SQLGetterSetter;

    public $id;
    public $uid;
    public $client_id;
    
    public $conn;
    public $table = "session";
    public $var = '*';
    public $data;

    // public $session_table;
    // public $auth_table;

    public $access_token;
    public $access_valid_for;
    public $refresh_token;
    public $refresh_valid_for;
    public $fingerprint;
    public $login_time;

    public static $static_id;
    public static $static_uid;
    public static $static_client_id;
    public static $static_refresh;

    public static function authenticate($user, $pass, $fingerprint = null){

        if($user){

            if($fingerprint == null) {

                if(isset($_COOKIE['fingerprint'])){
                    $fingerprint = $_COOKIE['fingerprint'];
                }

                if($fingerprint == null) {
                $fingerprint = 'finger.872ca8a179d42c06b950ae7fcd930392.print';
                }

            }

            $user = new User($user);

            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $client_id = "#".substr(md5(rand(100,9999)),15);
            $scope = "all";

            $ip_agent = md5($agent . $user);

            $access_token = md5(random_int(0, 9999999990) . $ip . $agent . time());
            $access_valid_for = 7200;

            $refresh_token = md5(random_int(0, 9999999990) . $ip . $agent . time());
            $refresh_valid_for = 7200;

            $sql = "INSERT INTO `session` (`uid`, `client_id`, `username`, `access_token`, `access_valid_for`, `created_at`, `login_time`, `refresh_token`, `refresh_valid_for`, `scope`, `ip`, `user_agent`, `ip_agent`, `active`, `fingerprint`)
            VALUES ('$user->uid', '$client_id', '$user', '$access_token', $access_valid_for, now(), now(), '$refresh_token', $refresh_valid_for, '$scope', '$ip', '$agent', '$ip_agent', '1', '$fingerprint')";

            $conn = Database::getConnection();

            if($conn->query($sql)){ 

                Session::set('session_token', $access_token);
                Session::set('refresh_token', $refresh_token);
                Session::set('fingerprint', $fingerprint);

                return array(
                "access_token" => $access_token,
                "refresh_token" => $refresh_token,
                "client_id" => $client_id,
                "scope" => $scope
                );

            } else{
                return false;
            }

        } else{
            return false;
        }

    }

    public static function authorize($access_token){

        try {
            $session = new UserSession($access_token);

            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER["HTTP_USER_AGENT"])) {
                if ($session->isValid() and $session->isActive() and $session->refreshAccess() and $session->getRefreshToken() == $_SESSION['refresh_token']) {
                    if ($_SERVER['REMOTE_ADDR'] == $session->getIP()) {
                        if ($_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent()) {

                            if($session->getFingerprint() == 'finger.872ca8a179d42c06b950ae7fcd930392.print'){
                                return $session;   

                            }elseif ($session->getFingerprint() == $_COOKIE['fingerprint']) {
                                return $session;
                            
                            } else {

                                $session->removeSession();
                                throw new Exception("FingerPrint doesn't match");

                            }
                        } else {

                            $session->removeSession();
                            throw new Exception("User agent does't match");

                        }
                    } else {

                        $session->removeSession();
                        throw new Exception("IP does't match");

                    }
                } else {

                    $session->removeSession();
                    throw new Exception("Invalid session");

                }
            } else {

                $session->removeSession();
                throw new Exception("IP and User_agent is null");

            }

        } catch (Exception $e) {
            throw new Exception("Something is wrong");
        }
    }

    public function __construct($access_token){

        $this->access_token = $access_token;
        $this->data = null;

        $sql = "SELECT * FROM `session` WHERE `access_token`= '$access_token' LIMIT 1";

        $this->conn = Database::getConnection();
        $result = $this->conn->query($sql);

        if ($result->num_rows) {

            $row = $result->fetch_assoc();
            
            $this->client_id = $row['client_id'];
            $this->login_time = $row['login_time'];

            $this->refresh_token = $row['refresh_token'];

            $this->data = $row;

            UserSession::$static_id = $row['id'];
            UserSession::$static_uid = $row['uid'];
            UserSession::$static_client_id = $row['client_id'];
            UserSession::$static_refresh = $row['refresh_token'];

            // $this->session_table = new GetSetDataHelper(UserSession::$static_id, UserSession::$static_uid, UserSession::$static_refresh, UserSession::$static_client_id, false, false, true, false, "session",'*');
            // $this->auth_table = new GetSetDataHelper(null, UserSession::$static_uid, UserSession::$static_refresh, null, false, false, true, false, 'auth', '*');

        } else {
            throw new Exception("Session is invalid");
        }

        $fingerprint = $this->data['fingerprint'];
        $fingerprint = strval($fingerprint);

        if ($fingerprint === 'finger.872ca8a179d42c06b950ae7fcd930392.print') {

            global $__is_fingerprint;
            $__is_fingerprint = true;

        } else{
            return false;
        }
        
    }

    public function is_valid_refresh(){

        $query = "SELECT * FROM session WHERE refresh_token = '$this->refresh_token';";
        $result = mysqli_query(Database::getConnection(), $query);

        if ($result) {

            $data = mysqli_fetch_assoc($result);
            $login_time = strtotime($data['login_time']);
            $expires_at = $login_time + $data['refresh_valid_for'];

            if (time() <= $expires_at) {
                return true;

            } else {
                if (!$this->conn) {
                    $this->conn = Database::getConnection();
                }
                
                try {

                    $sql = "UPDATE `session` SET `is_valid_refresh` = '0' WHERE ((`refresh_token` = '$this->refresh_token'));";
        
                    if ($this->conn->query($sql)) {
                        return false;
                    } else {
                        return true;
                    }
    
                } catch (Exception $e) {
                    throw new Exception(__CLASS__."::_setter() -> `refresh_token` data unavailable.");
                }
            }
        } else {
            throw new Exception(mysqli_error(Database::getConnection()->db));
        }
    }

    public function is_valid_access(){

        $query = "SELECT * FROM session WHERE access_token = '$this->access_token';";
        $result = mysqli_query(Database::getConnection(), $query);

        if ($result) {

            $data = mysqli_fetch_assoc($result);
            $created_at = strtotime($data['created_at']);
            $expires_at = $created_at + $data['access_valid_for'];

            if (time() <= $expires_at) {
                return true;
            } else {

                if (!$this->conn) {
                    $this->conn = Database::getConnection();
                }

                try {

                    $sql = "UPDATE `session` SET `is_valid_access` = '0' WHERE ((`access_token` = '$this->access_token'));";
        
                    if ($this->conn->query($sql)) {
                        return false;
                    } else {
                        return true;
                    }
    
                } catch (Exception $e) {
                    throw new Exception(__CLASS__."::_setter() -> `refresh_token` data unavailable.");
                }
            }
        } else {
            throw new Exception(mysqli_error(Database::getConnection()->db));
        }
    }

    public function setNewAccess(){
        if($this->is_valid_refresh()){

            $refresh_token = $this->refresh_token;
            $login_time = $this->login_time;

            $username = $this->getUsername();
            $session = new UserSession($this->access_token);
            $session->removeSession();
            
            if($username){
                $fingerprint = null;

                if($fingerprint == null) {

                    if(isset($_COOKIE['fingerprint'])){
                        $fingerprint = $_COOKIE['fingerprint'];
                    }

                    if($fingerprint == null) {
                    $fingerprint = 'finger.872ca8a179d42c06b950ae7fcd930392.print';
                    }
                }
    
                $user = new User($username);
    
                $ip = $_SERVER['REMOTE_ADDR'];
                $agent = $_SERVER['HTTP_USER_AGENT'];
                $client_id = "#".substr(md5(rand(100,9999)),15);;
                $scope = "all";
                $ip_agent = md5($agent . $username);

                $access_token = md5(random_int(0, 9999999990) . $ip . $agent . time());
                $access_valid_for = 7200;
                $refresh_valid_for = 7200;

                $sql = "INSERT INTO `session` (`uid`, `client_id`, `username`, `access_token`, `access_valid_for`, `created_at`, `login_time`, `refresh_token`, `refresh_valid_for`, `scope`, `ip`, `user_agent`, `ip_agent`, `active`, `fingerprint`)
                VALUES ('$user->uid', '$client_id', '$username', '$access_token', $access_valid_for, now(), '$login_time', '$refresh_token', $refresh_valid_for, '$scope', '$ip', '$agent', '$ip_agent', '1', '$fingerprint')";
    
                $conn = Database::getConnection();

                if($conn->query($sql)){ 

                    Session::set('session_token', $access_token);
                    Session::set('refresh_token', $refresh_token);
                    Session::set('fingerprint', $fingerprint);
    
                    return array(
                    "access_token" => $access_token,
                    "refresh_token" => $refresh_token,
                    "client_id" => $client_id,
                    "scope" => $scope
                    );
    
                } else{
                    return false;
                }
    
            } else{
                return false;
            }
        }else{
            return ["Valid Token", $this->access_token];
        }

    }

    public function refreshAccess()
    {

        if($this->is_valid_refresh()){

            if($this->is_valid_access()){
                return ["Valid Token", $this->access_token];
            }else {
                return $this->setNewAccess();
            }

        }else {
            return false;
        }
    }

    public function getUser(){
        return new User($this->uid);
    }

    public function isValid(){

        $cookie = isset($_COOKIE['fingerprint']);

        if($this->getFingerprint() == 'finger.872ca8a179d42c06b950ae7fcd930392.print'){
            return true;

        }elseif ($cookie == $this->getFingerprint()) {
            return true;

        } else {
            return false;
        }

        if (isset($this->data['login_time'])) {

            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);

            if (3600 > time() - $login_time->getTimestamp()) {
                return true;

            } else {
                return false;
            }

        } else {
            throw new Exception("login time is null");
        }

    }

    public function getIP(){
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getRefreshToken(){
        return isset($this->data["refresh_token"]) ? $this->data["refresh_token"] : false;
    }

    public function getUserAgent(){
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
    }

    public static function getAccessToken(){

        $data = new GetSetDataHelper("session", UserSession::$static_refresh);

        // $data->setClientId("#xxcdsddscfdscgv628");
        // $data->setRefreshValidFor(3);
        // $data->setAccessValidFor(3);

        return array(
            "access_token" => $data->getAccessToken(),
            "refresh_token" => $data->getRefreshToken(),
            "client_id" => $data->getClientId(),
            "scope" => $data->getScope()
        );

    }

    public function is_working_api(){

        $data = new GetSetDataHelper("session", $this->id, false, $this->uid, false, $this->refresh_token, true, $this->client_id, false);
      
        // $data->setClientId("#xx6fdsgv628");
        // $data->setAccessToken("#766776");
        // $data->setRefreshValidFor(3);
        // $data->setAccessValidFor(3);

        return array(

            "message" => "success",
            "New_client_id" => "Set By GetterSetter: ".$data->getClientId(),

            "returned_apis" => 
            [ "user_data" => ["user_id" => $this->data['uid'],
            "username" => $data->getUsername(),
            "client_id" => $this->data['client_id'],
            "active" => $this->data['active']],

            "browser_data" => ["fingerprint" => $this->data['fingerprint'],
            "ip" => $data->getIp(),
            "user_agent" => $data->getUserAgent()],

            "access_token" => ["NEW: access_token" => $this->data['access_token'],
            "created_at: " => $data->getCreatedAt(), "login_time" => $data->getLoginTime(),
            "access_valid_for" => $this->data['access_valid_for'],
            "is_vaild_access" => $this->data['is_valid_access']],

            "refresh_token" => ["NEW: refresh_token" => $this->data['refresh_token'],
            "refresh_valid_for" => $this->data['refresh_valid_for'],
            "is_vaild_refresh" => $this->data['is_valid_refresh'],
            "refresh_created_at" => $data->getLoginTime()]]
        );

    }

    public function deactivate(){

        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }

        $sql = "UPDATE `session` SET `active` = 0 WHERE `uid`=$this->uid";
        return $this->conn->query($sql) ? true : false;
    }

    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    public function getFingerprint()
    {
        if (isset($this->data['fingerprint'])) {
            return $this->data['fingerprint'];
        }
    }

    public static function is_fingerprint_allowed(){

        global $__is_fingerprint;

        if ($__is_fingerprint) {
            return true;
            
        }else{
            return false;
        }
    }

    public function removeSession() {
        if (isset($this->data['id'])) {

            $id = $this->data['id'];

            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }

            $sql = "DELETE FROM `session` WHERE `id` = $id;";

            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }

        }
    }

}