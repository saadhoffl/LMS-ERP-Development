<?php
include 'src/back-end/libs/load.php';

if(Session::isAuthenticated()){
    if(!user::verifyEmail()){
        header("Location: verify_account");
    }else{
        Session::renderPage();
    }
    
} else{
    Session::ensureLogin();
    // header("Location: /signin");
    die();
}

