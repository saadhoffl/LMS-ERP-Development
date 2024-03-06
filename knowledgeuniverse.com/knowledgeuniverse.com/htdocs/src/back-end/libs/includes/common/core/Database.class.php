<?php

class Database{
    public static $conn = null;
    public static $conn_userdata = null;

    public static function getConnection(){

        if(Database::$conn == null){

            $servername = get_config('db_server');
            $username = get_config('db_username');
            $password = get_config('db_password');
            $dbname = get_config('db_name');
            
            $connection = new mysqli($servername, $username, $password, $dbname);

            try {

                if ($connection->connect_error) {
                    throw new Exception("Connection failed: " . $connection->connect_error);
                } else {

                    Database::$conn = $connection;
                    return Database::$conn;
                }
                
            } catch (Exception $e) {

                echo "Error: " . $e->getMessage();
                Database::$conn = $connection;
                return Database::$conn;

            }

        } else {
            return Database::$conn;
        }
    }

    public static function getConnection_UserData(){

        if(Database::$conn_userdata == null){
                
            $servername = get_config('user_db_server');
            $username = get_config('user_db_username');
            $password = get_config('user_db_password');
            $dbname = get_config('user_db_name');
            
            $connection = new mysqli($servername, $username, $password, $dbname);

            try {

                if ($connection->connect_error) {
                    throw new Exception("Connection failed: " . $connection->connect_error);
                } else {

                    Database::$conn_userdata = $connection;
                    return Database::$conn_userdata;
                }
                
            } catch (Exception $e) {

                echo "Error: " . $e->getMessage();
                Database::$conn_userdata = $connection;
                return Database::$conn_userdata;

            }

        } else {
            return Database::$conn_userdata;
        }
    }
}