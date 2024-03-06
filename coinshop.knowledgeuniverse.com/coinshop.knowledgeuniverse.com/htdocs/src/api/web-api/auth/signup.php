<?php

${basename(__FILE__, '.php')} = function () {
    if ($this->paramsExists(['username', 'email', 'password'])) {
        $username = $this->_request['username'];
        $email = $this->_request['email'];
        $password = $this->_request['password'];

        $result = User::signup($username, $email, $password);
        if($result) {
            $this->response($this->json([
                'message'=>'Successfully Signed Up',
                'result' => $result
            ]), 200);
        } else {
            $this->response($this->json([
                'message'=>'Something went wrong',
                'result' => $result
            ]), 400);
        }

    } else {
        $this->response($this->json([
            'message'=>"bad request"
        ]), 400);
    }
};
