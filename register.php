
<div class="container text-center  p-3 bg-light text-dark" style="min-height:800px;">
  <div class="row d-flex flex-column justify-content-center bg-dark text-light pt-2">
	<a href = "http://rayscollectibles.com/dashboard/index.php"><img class="mb-4 mx-auto" style="border-radius:30px" src="./assets/img/rays-logo-simple.png" alt="Rays Collectibles" width="100" height="100"></a>

<?php
if (isset($_POST['btnRegister'])): 

	$errMsg = '';

	$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING) ?? '';
	$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? '';
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
	$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? '';
	$instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_STRING) ?? '';
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING) ?? '';
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? '';

	if ($firstname == '' || $lastname == '' || $phone == '' || $username == '' || $password == ''):
		$errMsg = "Missing field! ";

		$phone = preg_replace('/[^0-9+\(\)-]/', '', $phone);
		if (!preg_match('/^(\+1|001)?\(?([0-9]{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/', $phone)):
			$errMsg .= '<br>Invalid phone number provided.  Please use (999)999-9999 format.';
		endif;

		if($password <> ''):
		    if (strlen($password <= '8')):
		        $errMsg .= "Your Password Must Contain At Least 8 Characters!";
		    elseif(!preg_match("#[0-9]+#",$password)):
		        $errMsg .= "Your Password Must Contain At Least 1 Number!";
		    elseif(!preg_match("#[A-Z]+#",$password)):
		        $errMsg .= "Your Password Must Contain At Least 1 Capital Letter!";
		    elseif(!preg_match("#[a-z]+#",$password)):
		        $errMsg .= "Your Password Must Contain At Least 1 Lowercase Letter!";
		    endif;
		endif;	

	?>	
		<h4 class="text-light text-center h5 mt-2 mb-4">There was a problem with your form: </h4>
		<p class="text-danger"><?= "<br>".$errMsg; ?></p>

	<?php

	else:
		//process new form - save to database
		$ipAddr = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

		// check if username already exists
		$userExists = $users->getUserByUserName($username);

		if (empty($userExists))	:
			//$ipAllowed = $safedb->getOne('SELECT COUNT(*) AS `cnt` FROM `xcart_login_admin_ip` WHERE `ip`=?s', $ipAddr);

			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$data = [
				"firstname"=>$firstname,
				"lastname"=>$lastname,
				"email"=>$email,
				"phone"=>$phone,
				"username"=>$username,
				"password"=>$hashed_password,
				"ipaddress"=>$ipAddr
			];
			$result = $users->addPullUser($data);
		else:
			echo "<br> This Uer already exists with that username; Please use a different username.";
			$result = false;
		endif;
		if (!$result):
			echo '<div class="text-center alert alert-warning p-5 my-5 mx-5 h3">There was a problem saving your information.  Please contact Support at support@rayscollectibles.com.</div>';

		else:

?>
				<div class='text-center mt-5 h4'>Thank You for Registering!</div>
				<div class="text-warning mt-5 mb-5 p-5">Our Pull System is under maintenance at the moment.  <br><br>
					We will contact you shortly using the email provided regarding creating a Pull List for you with our store.
				</div>
				<div class="mb-5"><hr></div>
		  </div>
		</div>

<?php
		endif;
		exit;
	endif;
endif;
?>

    <h1 class="h3 mb-3 font-weight-normal">Register for our Pull List Portal below:</h1>
    <div class="d-flex justify-content-center">
	<form class="w-50 pb-3 needs-validation" method="post">
	  <div class="row mb-1 mt-3 ">
	    <div class="col">
	      <input type="text" name="firstname" class="form-control form-control-sm" placeholder="First name" required>
	    </div>
	    <div class="col">
	      <input type="text"  name="lastname" class="form-control form-control-sm" placeholder="Last name" required>
	    </div>
	  </div>
	  <div class="row mb-1 mt-3"> 
	    <div class="col">
	      <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" required>
	      <br><small>We will never sell your email.  We use this for sending you updates on your Pull Lists.</small>
	    </div>
	    <div class="col">
	      <input type="text" name="phone" class="form-control form-control-sm" placeholder="Phone" required>
	      <br><small>We will never sell your phone number.  We may need to contact you directly with respect to your account.</small>
	    </div>
	  </div>
	  <div class="row mb-1 mt-3">
	    <div class="col">
	      <input type="text" name="instagram" class="form-control form-control-sm" placeholder="Instagram Account">
	      <br><small>If you have an Instagram account, you will be able to view special discount codes we offer from time to time.</small>
	    </div>
	  </div>
	  <div class="row mb-1 mt-3">
	    <div class="col">
	      <input type="text" name="username" class="form-control form-control-sm" placeholder="User Name" required=>
	    </div>
	    <div class="col">
	      <input title="Passwords must be at least 8 characters, contain one Uppercase character, 1 number, 1 special character, 1 lower case letter." type="text" name="password" class="form-control form-control-sm" placeholder="Password" required>
	    </div>
        <div class="valid-tooltip">
          Passwords must be at least 8 characters, contain one Uppercase character, 1 number, 1 special character, 1 lower case letter.
        </div>
	  </div>
	  <button type="submit" name="btnRegister" class="btn btn-sm btn-ray mt-3 btn-warning text-light">Sign Me Up!</button>
	</form>
	</div>
  </div>
</div>