<?php

$login_page = true;

if (isset($_POST['email']) and isset($_POST['password'])) {
    $email_address = $_POST['email'];
    $password = $_POST['password'];

    $result = UserSession::authenticate($email_address, $password);
    $login_page = false;
}

if (!$login_page) {
    if ($result) {
        $should_redirect = Session::get('_redirect');
        $redirect_to = get_config('base_path');
        if (isset($should_redirect)) {
            $redirect_to = $should_redirect;
            Session::set('_redirect', false);
        }
        ?>
<script>
	window.location.href = "<?=$redirect_to?>"
</script>

<?php
    } else {
        ?>
        <div class="signup-container d-flex br-3 w-47 h-150 p-3 mx-auto flex-column">
            <h3 class="text-center h6 head-text mb-3 mt-4 small font-weight-normal">Signin Failed<br><br>
            <i><?
            if($result === false){
                  $result = "Invalid credentials, Enter valid credentials";
            }
            print("$result"); 
            
            ?></i></h3>
            <p class="text-center text-white h6 head-text mb-5 mt-3 small font-weight-normal">Click here to <a href="/signin.php">signin</a> again</p>
        </div>

<?php
    }
} else {
    ?>

<div class="signin-container mt-5 d-flex br-3 w-45 h-150 p-3 ps-5 pe-5 mx-auto flex-column">
<form method="post" action="/" class="form-signin">

<h6 class="text-start text-center text-secondary font-weight-normal">Complete your details, <br>
<i>Its help us to know your skill set and easy way to train and upgrade your skill set in specific area</i> <br><br>
<i>With help of your skill set details we will recommend our most sutable course for you !</i></h6>
      
 

</form>
</div>


<div class="text-center mb-5">
<span>
<a class="btn ms-5 me-5 p-1 mt-3 btn-sm text-primary btn-block link-underline link-underline-opacity-0" href="/"><b>Skip Now !</b></a></button>
<!-- <a class="btn ms-5 me-5 mt-3 p-1 btn-sm text-primary btn-block link-underline link-underline-opacity-0" href="/"><b>Final Submit!</b></a><b></b></button> -->
<a class="btn ms-5 me-5 mt-3 p-1 btn-sm text-primary btn-block link-underline link-underline-opacity-0" href="/skill_page_1.php"><b>Add Your Skills</b></a><b></b></button>
</span>
</div>

<?php
}
?>