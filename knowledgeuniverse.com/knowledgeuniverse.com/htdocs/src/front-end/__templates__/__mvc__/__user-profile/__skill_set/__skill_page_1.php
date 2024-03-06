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

<h6 class="text-start text-center text-secondary font-weight-normal">Complete your details,
<i>Its help us to train you better version of you</i></h6>

      <h3 class="h5 mb-3 mt-3 font-weight-normal text-white">Communication</h3>

      <?php
        if(isset($_GET['error'])) {
            ?>
		<div class="alert alert-danger" role="alert">
			Invalid Credentials
		</div>
		<?php
        }
    ?>
      
      <label for="inputFirst" class="sr-only text-white">Language's you know</label>
      <input name="name" type="user" id="first_name" class="form-control bg-dark text-white" 
      placeholder="Eg: English, Tamil, Malayalam" required="" autofocus="">

      <label for="inputLast" class="sr-only text-white">Mother tounge</label>
      <input name="name" type="user" id="last_name" class="form-control bg-dark text-white" 
      placeholder="Eg: Tamil, Hindi, malayalam" required="" autofocus="">

      <label for="dateOfBirth" class="sr-only text-white">Level of English Speeking</label>
      <input name="date_of_birth" type="user" id="date_of_birth" class="form-control bg-dark text-white" 
      placeholder="Out of 100 precentage" required="">

    <div class="text-center">
    <div class="row"><div class="col"></div>
    <div class="col">
    <button class="btn btn-outline-primary ps-2 pe-2 p-1 mt-4 btn-sm text-primary btn-block" type="button"><b>Submit</b></button>
    </div>
    <div class="col"></div>
    </div></div>

</form>
</div>


<div class="mt-1 text-center">
<span>
<a class="link-underline link-underline-opacity-0" href="/skill_page_1"><span style='font-size:23px; color:blue;'>&#9679;</span></a>
    <!-- <a class="link-underline link-underline-opacity-0" href="/contact_details"><span style='font-size:23px; color:dimgray;'>&#9679;</span></a>
    <a class="link-underline link-underline-opacity-0" href="/education_details"><span style='font-size:23px; color:dimgray;'>&#9679;</span></a>
    <a class="link-underline link-underline-opacity-0" href="/career_details"><span style='font-size:23px; color:dimgray;'>&#9679;</span></a>
    <a class="link-underline link-underline-opacity-0" href="/address_details"><span style='font-size:23px; color:dimgray;'>&#9679;</span></a>
    <a class="link-underline link-underline-opacity-0" href="/id_verification"><span style='font-size:23px; color:dimgray;'>&#9679;</span></a> -->
</span>
</div>

<div class="text-center mb-5">
<span>
<a class="btn ms-5 me-5 p-1 mt-3 btn-sm text-primary btn-block link-underline link-underline-opacity-0" href="/skill"><b>Back</b></a></button>
<!-- <a class="btn ms-5 me-5 mt-3 p-1 btn-sm text-primary btn-block link-underline link-underline-opacity-0" href="/"><b>Final Submit!</b></a><b></b></button> -->
<a class="btn ms-5 me-5 mt-3 p-1 btn-sm text-primary btn-block link-underline link-underline-opacity-0" href="#"><b>Next</b></a><b></b></button>
</span>
</div>

<?php
}
?>