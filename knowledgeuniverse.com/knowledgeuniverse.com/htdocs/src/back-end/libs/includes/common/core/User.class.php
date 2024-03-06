<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";

class User{

    use SQLGetterSetter;
    // use Mailosaur\MailosaurClient;
    // use Mailosaur\Models\SearchCriteria;

    private $conn;
    public $uid;
    public $username;
    public $table;
    public $row;

    public static function signup($user, $email, $pass){

        $options = [
            'cost' => 10,
        ];

        $pass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();

        $uid = substr(md5(rand(100,9999)),15);

        $token = md5(random_int(0, 9999999990) . time());

        $sql = "INSERT INTO `auth` (`uid`,`username`, `email`, `password`, `token`, `blocked`, `active`)
        VALUES ('$uid', '$user', '$email', '$pass', '$token', '0', '0')";
        
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

    public function email_verify(){

        // Available in the API tab of a server
        // $apiKey = 'API_KEY';
        // $serverId = 'SERVER_ID';

        // $mailosaur = new MailosaurClient($apiKey);

        // $criteria = new SearchCriteria();
        // $criteria->sentTo = 'TEST_EMAIL';

        // $email = $mailosaur->messages->get($serverId, $criteria);

        // print('Subject: ' . $email->subject);

        // $data = new GetSetDataHelper('auth', $this->uid);

        // $send_grid_api = get_config('email_verify_code');

        // $token = $data-> getToken();
        // $email = new \SendGrid\Mail\Mail();
        // $email->setFrom("noreply@selfmade.ninja", "API Course by Selfmade");
        // $email->setSubject("Verify your account");
        // $email->addTo($data->getEmail(), $this->username);
        // $email->addContent("text/plain", "Please verify your account at: http://localhost:8000/w/auth/verify_your_account?token=$token");
        // $email->addContent(
        //     "text/html",
        //     "<strong>Please verify your account by <a href=\"http://localhost:8000/w/auth/verify_your_account?token=$token\">clicking here</a> or open this URL manually: <a href=\"http://localhost:8000/w/auth/verify_your_account?token=$token\">http://localhost:8000/w/auth/verify_your_account?token=$token</a></strong>"
        // );
        // $sendgrid = new \SendGrid($send_grid_api);
        // try {
        //     $response = $sendgrid->send($email);
        //     // print $response->statusCode() . "\n";
        //     // print_r($response->headers());
        //     // print $response->body() . "\n";
        // } catch (Exception $e) {
        //     echo 'Caught exception: '. $e->getMessage() ."\n";
        // }
    }

    public static function verifyEmail(){
        $data = new GetSetDataHelper('auth', UserSession::$static_uid);
        if ($data->getActive() == 1) {
            return true;
        }else{
            return false;
        }
    }

    public static function verifyAccount($token)
    {
        $data = new GetSetDataHelper('auth', UserSession::$static_uid);

            if ($data->getActive() == 1) {
                throw new Exception("Already Verified");
            }else{
                $data->setActive(1);
                return true;
            }
    }

    public static function login($user, $pass){

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $ip_agent = md5($agent . $user);

        $query = "SELECT * FROM `session` WHERE `ip_agent` = '$ip_agent'";
        $conn = Database::getConnection();
        $data = $conn->query($query);

        $sql = "SELECT * FROM `auth` WHERE `username` = '$user' OR `email` = '$user'";

        $result = $conn->query($sql);

        if($result->num_rows >= 1){
            $row = $result->fetch_assoc();

            if(password_verify($pass, $row['password'])){

                if($data->num_rows >= 1){
                    $row1 = $data->fetch_assoc();
                    if($row1['ip_agent'] == $ip_agent){
        
                        $user_agent = $row1['user_agent'];
                        $sql1 = "DELETE FROM `session` WHERE `user_agent` = '$user_agent'";
                        $conn->query($sql1);
        
                    }      
                }
                
                return $row['username'];

            } else{
                return false;
            }
            
        } else{
            return false;
        }
    }

    public function __construct($username){

        $this->conn = Database::getConnection();
        $this->username = $username;

        $this->uid = null;
        $this->table = 'auth';

        $sql = "SELECT `uid` FROM `auth` WHERE `username`= '$username' OR `uid` = '$username' OR `email` = '$username' LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result->num_rows) {

            $row = $result->fetch_assoc();
            $this->uid = $row['uid'];

        } else {
            throw new Exception("Username does't exist");
        }
    }

}