<pre>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/libs/load.php';
$user = 'saadh';
$pass = isset($_GET['pass']) ? $_GET['pass'] : 'saadh';
$result = null;

if (isset($_GET['logout'])) {
    Session::destroy();
    exit("logout successfull, <a href='test.php'>Login Again</a>");
}

if (Session::get('is_loggedin')) {
    $username = Session::get('session_username');
    $userobj = new User($username);
    echo 'Welcome Back '.$userobj->getUsername();

} else {
    $result = User::login($user, $pass);

    if ($result) {
        $userobj = new User($result);
        echo 'Login Success ', $userobj->getUsername();
        Session::set('is_loggedin', true);
        Session::set('session_username', $result);
    } else {
        echo "Login failed, Invalid credential.<br>";
    }
}

echo <<<EOL
<br><br><a href="/test/test.php?logout">Logout</a>
EOL;
?>
</pre?