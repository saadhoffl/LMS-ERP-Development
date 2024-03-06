<?php

$signup = false;
if(isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password'])){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST["password"];
      $error = User::signup($username, $email, $password);
      $signup = true;
}

if($signup){
      if(!$error){
            if(!User::verifyEmail()){
                  header("Location: verify_account");
            }else{
                  header("Location: /");
            }

      } else {
            ?>

            <div class="signup-container d-flex br-2 w-47 h-150 p-3 mx-auto flex-column">
            <h3 class="text-center h6 head-text mb-3 mt-3 small font-weight-normal">Signup Failed<br><br>
            <i><?
            if($error === "Duplicate entry 'saadh' for key 'auth.username'"){
                  $error = "Username or Email is already exits";
            } elseif($error === "Duplicate entry 'saadh@saadh.com' for key 'auth.email'"){
                  $error = "Username or Email is already exits";
            }
            print("$error"); 
            
            ?></i></h3>
            <p class="text-center text-white h6 head-text mb-4 mt-4 small font-weight-normal">Click here to <a href="/signup">signup</a> again</p>
            </div>

            <?php
      }

} else {
      ?>
<div class="d-flex br-3 w-47 h-150 p-3 mx-auto flex-column">

<h3 class="h6 head-text mb-3 small font-weight-normal">Join with knowledegeuniverse Universe! to<br>
<i>Learn. Build. and Earn</i></h3>

</div>

<div class="signup-container d-flex br-3 w-46 h-150 p-4 mx-auto flex-column">
<form method="post" action="signup" class="form-signup">

      <h1 class="h3 mb-3 font-weight-normal text-white">Sign up</h1>

      <label for="inputUser" class="sr-only text-white">UserName</label>
      <input name="username" type="user" id="username" class="form-control bg-dark text-white" 
      placeholder="User Name" required="" autofocus="">

      <label for="inputEmail" class="sr-only text-white">Email</label>
      <input name="email" type="email" id="email" class="form-control bg-dark text-white" 
      placeholder="Email address" required="" autofocus="">

      <label for="inputPassword" class="sr-only text-white">Password</label>
      <input name="password" type="password" id="password" class="form-control bg-dark text-white" 
      placeholder="Password" required="">
      
      <button class="btn btn-sm btn-outline-light btn-block" type="submit"><b>Sign up</b></button>

</form>
</div>

<a class="mt-3 text-color link-underline link-underline-opacity-0 small mb-3 font-weight-normal" 
href="/signin"><b>Already have an account</b></a>
      <?php
}
?>