<?php 

if(!Session::isAuthenticated()){
    Session::loadTemplate('../../__templates__/__mvc__/__helpers/__is_loggedin');
}

?>
<?php Session::loadTemplate('__search') ?>

