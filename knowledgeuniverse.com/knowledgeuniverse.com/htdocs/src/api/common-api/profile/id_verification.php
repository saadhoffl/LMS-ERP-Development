<?php

${basename(__FILE__, '.php')} = function () {
    if(Session::isAuthenticated()){
        if ($this->paramsExists(['id_proof', 'id_number', 'id_saved_path'])) {
            $id_proof = $this->_request['id_proof'];
            $id_number = $this->_request['id_number'];
            $id_saved_path = $this->_request['id_saved_path'];

            $result = UserData::id_verification($id_proof, $id_number, $id_saved_path);
            if($result) {
                if($result == "Duplicate entry '2f229228204ea7201' for key 'id_proof.uid'"){
                    $this->response($this->json([
                        'message'=>'up-to-date',
                        'result' => "Your Id Verification details already up-to-date",
                        'completed' => UserData::is_id_proof_completed()
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