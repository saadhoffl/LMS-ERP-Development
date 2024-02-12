<?php
include 'src/back-end/libs/load.php';

if(Session::isAuthenticated()){
    Session::renderPage();
} else{
    Session::ensureLogin();
    // header("Location: /signin");
    die();
}

