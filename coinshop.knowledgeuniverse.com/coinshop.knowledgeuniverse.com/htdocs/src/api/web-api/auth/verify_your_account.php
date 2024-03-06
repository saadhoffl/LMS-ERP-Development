<?php

${basename(__FILE__, '.php')} = function () {

$token = mysqli_real_escape_string(Database::getConnection(), $_GET['token']);
try{
    if(User::verifyAccount($token)){
        ?>
        <h1 style="color: green">Verified</h1>
        <?php
    } else {
        ?>
        <h1 style="color: red">Cannot Verify</h1>
        <?php
    }
}
catch(Exception $e){
    ?>
    <h1 style="color: orange"><?=$e->getMessage()?></h1>
    <?php
}

};