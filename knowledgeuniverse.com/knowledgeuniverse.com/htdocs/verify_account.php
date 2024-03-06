<?php
include 'src/back-end/libs/load.php';

if(User::verifyEmail()){
    header("Location: /");
    die();
}

Session::renderPage();