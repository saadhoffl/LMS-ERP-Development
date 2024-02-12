<?php

class WebAPI{
    public function __construct(){

        if(php_sapi_name() == "cli"){

            global $__site_config;
            $__site_config_path = "/home/saadhoffl/WebApps/innovatement/lms-erp/lms-erp/lms-erp.com/myConfig/config.json";
            $__site_config = file_get_contents($__site_config_path);
            print($__site_config);

        } elseif(php_sapi_name() == "apache2handler"){

            // read if you linked any folder to /var/www/your_project.
            // $__site_config_path = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']).'/project/photogramconfig.json';
            // $__site_config = file_get_contents($__site_config_path);

            global $__site_config;
            $__site_config = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../config/lms-erp.com_config/config.json');
        }


        // global $__site_config;
        // $__site_config_path = __DIR__.'/../../../lms-erp.com_config/config.json';
        // $__site_config = file_get_contents($__site_config_path);
        
        Database::getConnection();
        
    }

    public function initiateSession(){

        Session::start();

        if (Session::isset("session_token")) {

            try {
                Session::$usersession = UserSession::authorize(Session::get('session_token')); 
            } 
            catch (Exception $e){
                //TODO: Handle error
            }
            
        }

    }
 
}