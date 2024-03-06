<?php

${basename(__FILE__, '.php')} = function () {
    if(Session::isAuthenticated()){
        if ($this->paramsExists(['house_no_name', 'area_colony', 'state', 'city', 'pincode'])) {
            $house_no_name = $this->_request['house_no_name'];
            $area_colony = $this->_request['area_colony'];
            $state = $this->_request['state'];
            $city = $this->_request['city'];
            $pincode = $this->_request['pincode'];

            $result = UserData::address($house_no_name, $area_colony, $state, $city, $pincode);
            if($result) {
                if($result == "Duplicate entry '2f229228204ea7201' for key 'address.uid'"){
                    $this->response($this->json([
                        'message'=>'up-to-date',
                        'result' => "Your address details already up-to-date"
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