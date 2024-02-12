<?php
include 'src/back-end/libs/load.php';

if(Session::isAuthenticated()){
    header("Location: /");
    die();
}

Session::renderPage();