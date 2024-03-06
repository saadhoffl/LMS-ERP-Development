<?php 

if(!Session::isAuthenticated()){
    Session::loadTemplate('../../__templates__/__mvc__/__purchases');
}

?>
