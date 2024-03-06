<?php

include_once 'includes/common/core/Database.class.php';
include_once 'includes/common/core/User.class.php';
include_once 'includes/common/core/API.class.php';
include_once 'includes/common/core/REST.class.php';
include_once 'includes/common/core/GetSetDataHelper.class.php';

include_once 'includes/web/core/Session.class.php';


global $__site_config;

function get_config($key, $default = null){

    global $__site_config;
    $array = json_decode($__site_config, true);

    if(isset($array[$key])){
        return $array[$key];
        
    } else{
        return $default;
    }
}

function loadTemplate($name){

    if(php_sapi_name() == "cli"){

        // nothing...

    } elseif(php_sapi_name() == "apache2handler"){

        include $_SERVER['DOCUMENT_ROOT'] . get_config('base_path') . "/src/front-end/__templates__/__core__/__$name.php";
        
    }

}