<?php

include_once __DIR__ . "/../../common/traits/SQLGetterSetter.trait.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/src/composer/vendor/autoload.php';

class User{

    use SQLGetterSetter;

    public function isAuthenticated(){
    
    }
}