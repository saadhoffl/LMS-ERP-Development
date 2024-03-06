<?php

${basename(__FILE__, '.php')} = function () {
    if(Session::isAuthenticated()){
        if ($this->paramsExists(['education_level', 'name_of_school_college', 'location_of_school_college', 'year_of_passing'])) {
            $education_level = $this->_request['education_level'];
            $name_of_school_college = $this->_request['name_of_school_college'];
            $location_of_school_college = $this->_request['location_of_school_college'];
            $year_of_passing = $this->_request['year_of_passing'];

            $result = UserData::education($education_level, $name_of_school_college, $location_of_school_college, $year_of_passing);
            if($result) {
                if($result == "Duplicate entry '2f229228204ea7201' for key 'education.uid'"){
                    $this->response($this->json([
                        'message'=>'up-to-date',
                        'result' => "Your education details already up-to-date"
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