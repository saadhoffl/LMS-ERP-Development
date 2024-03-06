<?php

${basename(__FILE__, '.php')} = function () {
    if(Session::isAuthenticated()){
        if ($this->paramsExists(['first_name', 'last_name', 'date_of_birth'])) {
            $first_name = $this->_request['first_name'];
            $last_name = $this->_request['last_name'];
            $date_of_birth = $this->_request['date_of_birth'];

            $result = UserData::personal($first_name, $last_name, $date_of_birth);
            if($result) {
                if($result == "Duplicate entry '2f229228204ea7201' for key 'personal.uid'"){
                    $this->response($this->json([
                        'message'=>'up-to-date',
                        'result' => "Your personal details already up-to-date"
                    ]), 400);
                } else{
                    $this->response($this->json([
                        'message'=>'Something went wrong',
                        'result' => $result
                    ]), 400);
                }

            } else {
                $this->response($this->json([
                    'message'=>'success',
                    'result' => true
                ]), 200);
            }

        } else {
            $this->response($this->json([
                'message'=>"bad request"
            ]), 400);
        }
    } else{
        $this->response($this->json([
            'message'=>"Unauthorized"
        ]), 401);
    }    
};