<?php

${basename(__FILE__, '.php')} = function () {
    if(Session::isAuthenticated()){
        if ($this->paramsExists(['country_code', 'phone_number', 'whatsapp_number', 'telegram_username', 'contact_email'])) {
            $country_code = $this->_request['country_code'];
            $phone_number = $this->_request['phone_number'];
            $whatsapp_number = $this->_request['whatsapp_number'];
            $telegram_username = $this->_request['telegram_username'];
            $contact_email = $this->_request['contact_email'];

            $result = UserData::contact($country_code, $phone_number, $whatsapp_number, $telegram_username, $contact_email);
            if($result) {
                if($result == "Duplicate entry '2f229228204ea7201' for key 'contact.uid'"){
                    $this->response($this->json([
                        'message'=>'up-to-date',
                        'result' => "Your contact details already up-to-date"
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