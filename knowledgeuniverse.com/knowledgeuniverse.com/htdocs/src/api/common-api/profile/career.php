<?php

${basename(__FILE__, '.php')} = function () {
    if(Session::isAuthenticated()){
        if ($this->paramsExists(['occupation', 'company_name', 'working_domain', 'working_experience', 'current_package'])) {
            $occupation = $this->_request['occupation'];
            $company_name = $this->_request['company_name'];
            $working_domain = $this->_request['working_domain'];
            $working_experience = $this->_request['working_experience'];
            $current_package = $this->_request['current_package'];

            $result = UserData::career($occupation, $company_name, $working_domain, $working_experience, $current_package);
            if($result) {
                if($result == "Duplicate entry '2f229228204ea7201' for key 'career.uid'"){
                    $this->response($this->json([
                        'message'=>'up-to-date',
                        'result' => "Your career details already up-to-date"
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