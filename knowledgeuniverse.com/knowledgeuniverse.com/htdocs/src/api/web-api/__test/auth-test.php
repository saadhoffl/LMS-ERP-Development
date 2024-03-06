<?php

${basename(__FILE__, '.php')} = function () {
    $this->response($this->json(['SCRIPT_NAME'=>$_SERVER['SCRIPT_NAME']]), 200);
};