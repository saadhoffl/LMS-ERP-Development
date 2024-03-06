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
        if(!User::verifyEmail()){
            header("Location: verify_account");
        }else{
            $redirect_to = get_config('base_path');
        }

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
            <p class="text-center text-white h6 head-text mb-5 mt-3 small font-weight-normal">Click here to <a href="/signin">signin</a> again</p>
        </div>

<?php
    }
} else {
    ?>

<div class="d-flex br-3 w-47 h-150 p-3 mx-auto flex-column">

<h3 class="h6 head-text mb-3 small font-weight-normal">Welcome to knowledegeuniverse Universe!<br>
<i>Learn. Build. and Earn</i></h3>

</div>

<div class="signin-container d-flex br-3 w-47 h-150 p-3 mx-auto flex-column">
<form method="post" action="signin" class="form-signin">

      <h1 class="h3 mb-3 font-weight-normal text-white">Sign in</h1>

      <?php
        if(isset($_GET['error'])) {
            ?>
		<div class="alert alert-danger" role="alert">
			Invalid Credentials
		</div>
		<?php
        }
    ?>
      
      <label for="inputEmail" class="sr-only text-white">Email or UserName</label>
      <input name="email" type="user" id="inputEmail" class="form-control bg-dark text-white" 
      laceholder="Email address" required="" autofocus="">

      <label for="inputPassword" class="sr-only text-white">Password</label>
      <input name="password" type="password" id="inputPassword" class="form-control bg-dark text-white" 
      placeholder="Password" required="">

      <div class="checkbox mb-3">
        <label class="text-white">
          <input type="checkbox" value="remember-me" class="text-white"> Remember me
        </label>
      </div>

      <button class="btn btn-sm btn-outline-light btn-block" type="submit"><b>Sign in</b></button>

</form>
</div>

<a class="mt-3 text-color link-underline link-underline-opacity-0 small mb-3 font-weight-normal" 
href="/signup"><b>Create new account</b></a>

<?php
}
?>