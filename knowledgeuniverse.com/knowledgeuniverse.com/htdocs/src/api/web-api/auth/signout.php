<?php

${basename(__FILE__, '.php')} = function () {
    if ($this->get_request_method() == "POST" and isset($this->_request['signout'])) {
        if (Session::isset("session_token")) {
            $Session = new UserSession(Session::get("session_token"));
            if ($Session->removeSession()) {
                $this->response($this->json([
                    'message'=>'signout succesfull',
                ]), 200);
            } else {
                $this->response($this->json([
                    'message'=>'signout failed',
                ]), 400);
            }
        }
        Session::destroy();
    }else{
        $this->response($this->json([
            'message'=>'bad request',
        ]), 400);
    }
};