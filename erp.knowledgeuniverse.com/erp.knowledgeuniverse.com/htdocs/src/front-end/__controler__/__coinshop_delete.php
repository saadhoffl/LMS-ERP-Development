<?php 

if(!Session::isAuthenticated()){
    Session::loadTemplate('../../__templates__/__mvc__/__coinshop_delete');
}

?>