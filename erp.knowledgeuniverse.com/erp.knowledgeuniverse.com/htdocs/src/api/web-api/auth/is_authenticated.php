<?php

${basename(__FILE__, '.php')} = function () {

    if(Session::isAuthenticated()){
        $data = [
            "message" => "you are loggedin",
            "return" => true
        ];
        $data = $this->json($data);
        $this->response($data, 200);
    } else {
        $data = [
            "message" => "you are not loggedin",
            "return" => false
        ];
        $data = $this->json($data);
        $this->response($data, 400);
    }

};
