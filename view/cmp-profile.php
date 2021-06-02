<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../view/job.css">
	<link rel="stylesheet" href="../view/menu.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script type="text/javascript" src="../assets/jquery/jquery-3.5.1.min.js"></script>
</head>
<body>
	<div class="menu">
        <ul>
        	<h2 style="color:#85144b">CAREER FINDER</h2>
        	<li><a href="companyController.php?r=profile"><i class="fa fa-user">My Profile</i></a></li>
        	<li><a href="companyController.php"><i class="fa fa-home">Home</i></a></li>
        	<li><a href="../view/dbms3.html"><i class="fa fa-users">About Us</i></a></li>
        	<li><a href="loginController.php?r=logout"><i class="fa fa-sign-out">Logout</i></a></li>
        </ul>
    </div>

	<h1 align = "center">My Profile</h1>
	<div class = "form_wrapper">
    	<form method="post" action="companyController.php?r=profile">
    		<div class="row">
    			<div class="lbl">
        			<label for="cmpname">Company name:</label>
        		</div>
				<div class="field">
            		<input type="text" name="cmpname" id="cmpname" placeholder="Companyname" value="<?=@$data['CMPNAME']?>">
                	<div class="error"><?= @$error['cmpname'] ?></div>
        		</div>
			</div>

			<div class="row">
    			<div class="lbl">
    				<label for="country">Country:</label>

    			</div>
    			<div class="field">
        			<input type="text" name="country" id="country" placeholder="Country" value="<?=@$data['COUNTRY']?>">
                	<div class="error"><?= @$error['ecountry'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="state">State:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="state" id="state" placeholder="State" value="<?=@$data['STATE']?>">
                	<div class="error"><?= @$error['estate'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="city">City:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="city" id="city" placeholder="City" value="<?=@$data['CITY']?>">
                	<div class="error"><?= @$error['ecity'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="pincode">Pincode:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="pincode" id="pincode" placeholder="Pincode" value="<?=@$data['PINCODE']?>">
                	<div class="error"><?= @$error['epincode'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="phone">Phone Number:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="phone" id="phone" placeholder="PhoneNumber" value="<?=@$data['PHONE']?>">
                	<div class="error"><?= @$error['ephone'] ?></div>
    			</div>
    		</div>

			<br>
		    <div class="btn">
        		<input type="submit" name="saveprofile" value="Save">
        		<a href="companyController.php">Exit</a>
        	</div>
    	</form>
    </div>
</body>
<script>
	$(document).ready(function{
		error = <?= @$error['message']?>
		if(error != ""){
			alert(error);
		}
	)};
</script>
</html>