<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" href="/favicon.png">
   	<link rel="stylesheet" href="../view/login.css">
   	<link rel="stylesheet" href="../view/menu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../assets/jquery/jquery-3.5.1.min.js"></script>
<body>
    <div class="menu">
        <ul>
        <h2 style="color:#85144b">CAREER FINDER</h2>
        <li></li>
        <li></li>
        <li><a href="loginController.php"><i class="fa fa-home">Home</i></a></li>
        <li><a href="../view/dbms3.html"><i class="fa fa-users">About Us</i></a></li>
        </ul>
    </div>

    <br><br>
    <div class="login-wrapper">
    	<div class="login_head"><h3>Login/Register</h3></div>

   		<div class="login-inner">
    		<div class="user_emp" onclick="empLogin();"><i class="fa fa-user">Users</i></div>
    		<div class="user_cmp" onclick="cmpLogin();"><i class="fa fa-building">Company</i></div>
		</div>

		<div class="login-employee">
			<div>
				<h3>User Login</h3>
				<br><br>
    			<form action="loginController.php?r=login" method="post">
        			<div class="error"><?= @$error['einvalid'] ?></div>
        			<label for="uname">Username:</label>
        			<input type="text" name="uname" id="uname" placeholder="Username" value="<?=@$data['eluname']?>" autofocus>

        			<br><br>
        			<label for="pass">Password:</label>
        			<input type="password" name="pass" id="pass" placeholder="Password" value="<?=@$data['elpass']?>">

        			<br><br>
        			<div class="btn">
        				<input type="submit" name="login_emp" value="Login">
        				<input type="button" name="register_emp" value="Register" onclick="empRegister();"><br><br>
        				<i class="imp">*Register if not already</i>
        			</div>

        			<input type="hidden" name="type" value="employee">
    			</form>
			</div>
		</div>

		<div class="register-employee">
			<div>
				<h3>User Register</h3>
				<br><br>

				<form action = "loginController.php?r=register" method="post">
                	<label for="fname">First name:</label>
                	<input type="text" name="fname" id="fname" placeholder="Firstname" value="<?=@$data['efname']?>">
                	<div class="error"><?= @$error['efname'] ?></div>

                	<br><br>
                	<label for="lname">Last name:</label>
                	<input type="text" name="lname" id="lname" placeholder="Lastname" value="<?=@$data['elname']?>">
                	<div class="error"><?= @$error['elname'] ?></div>

                	<br><br>
                	<label for="uname">Email ID:</label>
                	<input type="email" name="emailid" id="emailid" placeholder="Email" value="<?=@$data['eemailid']?>">
                	<div class="error"><?= @$error['eemailid'] ?></div>

                	<br><br>
                	<label for="uname">User name:</label>
                	<input type="text" name="uname" id="uname" placeholder="Username" value="<?=@$data['euname']?>">
                	<div class="error"><?= @$error['euname'] ?></div>

                	<br><br>
                	<label for="pass">Password:</label>
                	<input type="password" name="pass" id="pass" placeholder="Password" value="<?=@$data['epass']?>">
                	<div class="error"><?= @$error['epass'] ?></div>

                	<br><br>
                	<fieldset>
                	<legend>Gender:</legend>

                	<input type="radio" name="gender" id="male" value="M" <?=@$data['egender']=='M'?'checked="checked"':''?>>
                	<label for="male">Male</label>

                	<input type="radio" name="gender" id="female" value="F" <?=@$data['egender']=='F'?'checked="checked"':''?>>
                	<label for="female">Female</label>

                	<input type="radio" name="gender" id="other" value="O" <?=@$data['egender']=='O'?'checked="checked"':''?>>
                	<label for="other">Other</label>
                	</fieldset>
                	<div class="error"><?= @$error['egender'] ?></div>

                	<br><br>
                	<label for="age">Age:</label>
                	<input type="text" name="age" id="age" placeholder="Age" value="<?=@$data['eage']?>">
                	<div class="error"><?= @$error['eage'] ?></div>

                	<br><br>
                	<label for="country">Country:</label>
                	<input type="text" name="country" id="country" placeholder="Country" value="<?=@$data['ecountry']?>">
                	<div class="error"><?= @$error['ecountry'] ?></div>

                	<br><br>
                	<label for="state">State:</label>
                	<input type="text" name="state" id="state" placeholder="State" value="<?=@$data['estate']?>">
                	<div class="error"><?= @$error['estate'] ?></div>

                	<br><br>
                	<label for="city">City:</label>
                	<input type="text" name="city" id="city" placeholder="City" value="<?=@$data['ecity']?>">
                	<div class="error"><?= @$error['ecity'] ?></div>

                	<br><br>
                	<label for="pincode">Pincode:</label>
                	<input type="text" name="pincode" id="pincode" placeholder="Pincode" value="<?=@$data['epincode']?>">
                	<div class="error"><?= @$error['epincode'] ?></div>

                	<br><br>
                	<label for="phone">Phone Number:</label>
                	<input type="text" name="phone" id="phone" placeholder="PhoneNumber" value="<?=@$data['ephone']?>">
                	<div class="error"><?= @$error['ephone'] ?></div>

                	<br><br>
                	<div class="btn">
                		<input type="submit" name="register" value="Register">
                	</div>

                	<br><br>
                	<input type="hidden" name="type" value="employee">
                </form>
			</div>
		</div>

		<div class="login-cmp">
			<div>
				<h3>Company Login</h3>
				<br><br>

    			<form action="loginController.php?r=login" method="post">
        			<div class="error"><?= @$error['cinvalid'] ?></div>
        			<label for="uname">Username:</label>
        			<input type="text" name="uname" id="uname" placeholder="Username" value="<?=@$data['cluname']?>">

        			<br><br>
        			<label for="pass">Password:</label>
        			<input type="password" name="pass" id="pass" placeholder="Password" value="<?=@$data['clpass']?>">

        			<br><br>
        			<div class="btn">
        				<input type="submit" name="login_cmp" value="Login">
        				<input type="button" name="register_cmp" value="Register" onclick="cmpRegister();"><br><br>
        				<i class="imp">*Register if not already</i>
        			</div>

        			<input type="hidden" name="type" value="company">
    			</form>
			</div>
		</div>

		<div class="register-cmp">
			<div>
				<h3>Company Register</h3>
				<br><br>

				<form action = "loginController.php?r=register" method="post">
                    <label for="cmpname">Company name:</label>
                    <input type="text" name="cmpname" id="cmpname" placeholder="Company name" value="<?=@$data['ccmpname']?>">
                    <div class="error"><?= @$error['cmpname'] ?></div>

                	<br><br>
                	<label for="uname">User name:</label>
                	<input type="text" name="uname" id="uname" placeholder="Username" value="<?=@$data['cuname']?>">
                	<div class="error"><?= @$error['cuname'] ?></div>

                    <br><br>
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" id="pass" placeholder="Password" value="<?=@$data['cpass']?>">
                	<div class="error"><?= @$error['cpass'] ?></div>

                    <br><br>
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" placeholder="Country" value="<?=@$data['ccountry']?>">
                	<div class="error"><?= @$error['ccountry'] ?></div>

                    <br><br>
                    <label for="state">State:</label>
                    <input type="text" name="state" id="state" placeholder="State" value="<?=@$data['cstate']?>">
                	<div class="error"><?= @$error['cstate'] ?></div>

                    <br><br>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" placeholder="City" value="<?=@$data['ccity']?>">
                	<div class="error"><?= @$error['ccity'] ?></div>

                    <br><br>
                    <label for="pincode">Pincode:</label>
                    <input type="text" name="pincode" id="pincode" placeholder="Pincode" value="<?=@$data['cpincode']?>">
                	<div class="error"><?= @$error['cpincode'] ?></div>

                	<br><br>
                	<label for="phone">Phone Number:</label>
                	<input type="text" name="phone" id="phone" placeholder="PhoneNumber" value="<?=@$data['cphone']?>">
                	<div class="error"><?= @$error['cphone'] ?></div>

                    <br><br>
                    <div class="btn">
                    	<input type="submit" name="register" value="Register">
                    </div>

                    <br><br>
                    <input type="hidden" name="type" value="company">
                </form>
			</div>
		</div>
    </div>
</body>
</html>

<script type="text/javascript">
	$(function(){

		if("<?= @$error['type'] ?>" == "RegisterCompany"){
				cmpRegister();
		}else if("<?= @$error['type'] ?>" == "RegisterEmployee"){
				empRegister();
		}else if("<?= @$error['type'] ?>" == "LoginCompany"){
				cmpLogin();
		}else{
			$(".register-employee").hide();
			$(".register-cmp").hide();
			$(".login-cmp").hide();
			$(".login-employee").show();
			$(".user_emp").addClass('active');
		}
		if("<?= @$data['result'] ?>" != ''){
			alert("<?= @$data['result'] ?>");
		}
	});

	function empLogin(){
		$(".register-employee").hide();
		$(".register-cmp").hide();
		$(".login-cmp").hide();
		$(".login-employee").show();
		$(".user_cmp").removeClass('active');
		$(".user_emp").addClass('active');

	}

	function cmpLogin(){
		$(".register-employee").hide();
		$(".register-cmp").hide();
		$(".login-cmp").show();
		$(".login-employee").hide();
		$(".user_cmp").addClass('active');
    	$(".user_emp").removeClass('active');
	}

   	function empRegister(){
		$(".register-employee").show();
		$(".register-cmp").hide();
		$(".login-cmp").hide();
		$(".login-employee").hide();
		$(".user_cmp").removeClass('active');
		$(".user_emp").addClass('active');
	}

	function cmpRegister(){
		$(".register-employee").hide();
		$(".register-cmp").show();
		$(".login-cmp").hide();
		$(".login-employee").hide();
		$(".user_cmp").addClass('active');
    	$(".user_emp").removeClass('active');
	}

</script>