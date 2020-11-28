<?php 
$errMsg = "";
$msgClass = "d-none invisible";
if ( isset($_POST['forgotpassword']) ):
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  echo "sending reset link to ".$email;
  //send email with link, saving request in db with token to validate upon click
  exit;
  //todo:  verify username exists, and email exists and then send email with link
elseif (isset($_POST['username']) && isset($_POST['password'])):
   //print_r($_POST);
   $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
   $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
   $userInfo = $users->getUserByUsername($_POST['username'])[0];
   //echo "<br> results:";print_r($userInfo);
   if ( isset($userInfo['userid']) ):
      $hashed_password = $userInfo['password'];
      if(password_verify($password, $hashed_password) || $password == $hashed_password):
          header('Location: https://www.rayscollectibles.com/dashboard/index.php?page=pulluser');
        else:
          $errMsg = "We could not verify your login information.  Please try again.";
      endif;
   else:
      $errMsg = "Username not found.  Please enter another username.";
   endif;
else:
   $errMsg = "Please enter both username and password";
endif;

if ($errMsg <> ""):
    $msgClass = 'alert alert-warning';
    //echo "<br> error:".$errMsg;
endif;

/* login post
username: superuser
password: admin
remember: remember
forgot: forgot
*/

/*
// Query the database for username and password
// ...

if(password_verify($password, $hashed_password)) {
    // If the password inputs matched the hashed password in the database
    // Do something, you know... log them in.
} 

// Else, Redirect them back to the login page.


 */
?>

<div class="container-fluid text-center w-50 bg-light text-dark" style="min-height:800px;">
  <div class="row d-flex flex-column justify-content-center bg-dark text-light p-3">
    <a href = "http://rayscollectibles.com/dashboard/index.php">
      <img class="mb-4 mx-auto" src="./assets/img/logo-border.png" alt="Rays Collectibles" width="150" height="150">
    </a>
    <h3>Pull List Portal</h3>
    <h1 class="h5 mb-3 font-weight-normal text-center">Please Sign In</h1>
    <div class="h6 <?= $msgClass; ?>"><?php if ($errMsg <> ''): echo $errMsg; endif; ?></div>
    <form class="form-signin mb-3" method="post">
      <div class="d-flex align-items-center justify-content-space-between flex-column">
        <div class="form-group">
          <label for="inputUsername" class="sr-only">Username</label>
          <input type="text" id="inputUsername" name="username" class="form-control mb-2" placeholder="Username" required autofocus>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="password" class="form-control mb-2" placeholder="Password" required>
        </div>
<!--    to implement later with secure-rememberme.zip saved in documents/raycns     
        <div class="checkbox mb-2">
          <label>
            <input type="checkbox" name="remember" value="remember" id="remember" title=""> Remember Me
          </label>
        </div> -->
        <div class="d-flex flex-column justify-content-space-between align-content-center w-25 mx-auto">
          <button class="btn btn-sm btn-warning text-dark mt-3 mb-3" type="submit">Sign in</button>
          <button type="button" class="btn btn-sm btn-outline-warning mb-3" data-toggle="modal" data-target="#forgotModal"> Forgot Password</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal" tabindex="-1" id="forgotModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Help I Forgot my Password!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>To reset your password, please enter your username and email below.  We will send you a link to help you change your password and log you in.</p>
        <form method="post" action="login.php" name="forgotPasswordForm">
          <input type="hidden" name="forgotpassword" value="send">
          <div class="form-group">
            <label for="">Username:</label>
            <input type="text" required class="form-control" name="username" placeholder="Enter your username" value="">
          </div>
          <div class="form-group">
            <label for="">Email:</label>
            <input type="text" required class="form-control" name="email" placeholder="Enter your email address" value="">
          </div>
          <div class="form-group">
            <button type="submit" name="forgotPassword" class="btn btn-sm btn-success">Submit</button>
          </div>
        </form>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
