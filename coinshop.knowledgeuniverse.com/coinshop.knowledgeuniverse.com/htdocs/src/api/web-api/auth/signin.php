<?php

${basename(__FILE__, '.php')} = function () {
    if(!Session::isAuthenticated()){
        if ($this->paramsExists(['username', 'password'])) {
            $username = $this->_request['username'];
            $password = $this->_request['password'];
            $token = UserSession::authenticate($username, $password);
            if($token) {
                $this->response($this->json([
                    'message'=>'Authenticated',
                    'token' => $token,
                ]), 200);
            } else {
                $this->response($this->json([
                    'message'=>'Unauthorized',
                    'token' => $token
                ]), 401);
            }
    
        } else {
            $this->response($this->json([
                'message'=>"bad request"
            ]), 400);
        }
    } else{
        $this->response($this->json([
            'message'=>'Already loggedin',
            'access_token' => UserSession::getAccessToken(),
        ]), 200);
    }
};
