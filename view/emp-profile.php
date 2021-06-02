<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="/favicon.png">
	<link rel="stylesheet" href="../view/job.css">
	<link rel="stylesheet" href="../view/menu.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script type="text/javascript" src="../assets/jquery/jquery-3.5.1.min.js"></script>
</head>
<body>
	<div class="menu">
        <ul>
        	<h2 style="color:#85144b">CAREER FINDER</h2>
        	<li><a href="employeeController.php?r=profile"><i class="fa fa-user">My Profile</i></a></li>
        	<li><a href="employeeController.php"><i class="fa fa-home">Home</i></a></li>
        	<li><a href="../view/dbms3.html"><i class="fa fa-users">About Us</i></a></li>
        	<li><a href="loginController.php?r=logout"><i class="fa fa-sign-out">Logout</i></a></li>
        </ul>
    </div>

	<h1 align = "center">My Profile</h1>
	<div class = "form_wrapper">
    	<form method="post" action="employeeController.php?r=profile" enctype="multipart/form-data">
    		<div class="row">
    			<div class="lbl">
        			<label for="fname">First name:</label>
        		</div>
				<div class="field">
            		<input type="text" name="fname" id="fname" placeholder="Firstname" value="<?=$data['FNAME']?>">
                	<div class="error"><?= @$error['efname'] ?></div>
        		</div>
			</div>


    		<div class="row">
    			<div class="lbl">
    				<label for="lname">Last name:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="lname" id="lname" placeholder="Lastname" value="<?=$data['LNAME']?>">
                	<div class="error"><?= @$error['elname'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
        		<label>Gender:</label>
        		</div>
        		<div class="field">
            		<div class="radio">
            		<input type="radio" name="gender" id="male" value="M" <?= @$data['GENDER']=='M' ? 'checked = "checked"':'' ;?>>
                	<label for="male">Male</label>
            		</div>
            		<div class="radio">
            		<input type="radio" name="gender" id="female" value="F" <?= @$data['GENDER']=='F' ? 'checked = "checked"':'' ;?>>
                	<label for="female">Female</label>
            		</div>
            		<div class="radio">
            		<input type="radio" name="gender" id="other" value="O" <?= @$data['GENDER']=='O' ? 'checked = "checked"':'' ;?>>
                	<label for="other">Other</label>
            		</div>
	        		<div class="error"><?= @$error['egender']?></div>
        		</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="age">Age:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="age" id="age" placeholder="Age" value="<?=$data['AGE']?>">
                	<div class="error"><?= @$error['eage'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="country">Country:</label>

    			</div>
    			<div class="field">
        			<input type="text" name="country" id="country" placeholder="Country" value="<?=$data['COUNTRY']?>">
                	<div class="error"><?= @$error['ecountry'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="state">State:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="state" id="state" placeholder="State" value="<?=$data['STATE']?>">
                	<div class="error"><?= @$error['estate'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="city">City:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="city" id="city" placeholder="City" value="<?=$data['CITY']?>">
                	<div class="error"><?= @$error['ecity'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="pincode">Pincode:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="pincode" id="pincode" placeholder="Pincode" value="<?=$data['PINCODE']?>">
                	<div class="error"><?= @$error['epincode'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="phone">Phone Number:</label>
    			</div>
    			<div class="field">
        			<input type="text" name="phone" id="phone" placeholder="PhoneNumber" value="<?=$data['PHONE']?>">
                	<div class="error"><?= @$error['ephone'] ?></div>
    			</div>
    		</div>

			<div class="row">
    			<div class="lbl">
    				<label for="emailid">Email id:</label>
    			</div>
    			<div class="field">
        			<input type="email" name="emailid" id="emailid" placeholder="Email" value="<?=$data['EMAILID']?>">
                	<div class="error"><?= @$error['eemail'] ?></div>
    			</div>
    		</div>


    		<div class="row">
    			<div class="lbl">
	        		<label for="education">Educational Qualification:</label>
	        	</div>
        		<div class="field">
            		<input type="text" id="education" name="education" value="<?=@$data['EDUCATION']?>">
            		<div class="error"><?= @$error['education']?></div>
        		</div>
    		</div>

    		<div class="row">
    			<div class="lbl">
        			<label for="skills">Skills:</label>
        		</div>
        		<div class="field">
            		<textarea id="skills" name="skills" rows="4" cols="50"><?=@$data['SKILLS']?></textarea>
            		<div class="error"><?= @$error['skills']?></div>
        		</div>
    		</div>

			<div class="row">
    			<div class="lbl">
	        		<label for="experience">Experience(in years):</label>
	        	</div>
        		<div class="field">
            		<input type="number" id="experience" name="experience" value="<?=@$data['EXPERIENCE'] == 0 ? '':@$data['EXPERIENCE'];?>">
            		<div class="error"><?= @$error['experience']?></div>
        		</div>
    		</div>

    		<?php if (!empty(@$data['CV_PATHNAME'])) : ?>

			<div class="row">
    			<div class="lbl">
	        		<label for="experience">Download your resume:</label>
	        	</div>
        		<div class="field">
            		<a target="_blank" href="employeeController.php?r=profileddownload&uid=<?= @$data['ID'] ?>" >MY RESUME</a>
        		</div>
    		</div>

			<?php endif; ?>
    		<div class="row">
    			<div class="lbl">
        			<label for="vacancy">Resume:</label>
        		</div>
        		<div class="field">
            		<input type="file" id="resume" name="resume" accept=".doc,.docx,.pdf">
            		<div class="error"><?= @$error['eresume']?></div>
        		</div>
    		</div>

			<input type="hidden" name="cv_name" value="<?= @$data['CV_NAME']?>">
			<input type="hidden" name="cv_pathname" value="<?= @$data['CV_PATHNAME']?>">
			<br>
            <div class="btn">
        		<input type="submit" name="saveprofile" value="Save">
        		<a href="employeeController.php">Exit</a>
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
	});
</script>
</html>