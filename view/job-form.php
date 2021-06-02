<?php
    $request = @$_REQUEST['r'];
    if($request == 'newJob'){
        $url = "companyController.php?r=newJob";
    }else if($request == 'editJob'){
        $url = "companyController.php?r=editJob&job=".@$_REQUEST['job']."";
    }
?>
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
        <li><a href="companyController.php?r=profile"><i class="fa fa-user">My Profile</i></a></li>
        <li><a href="companyController.php"><i class="fa fa-home">Home</i></a></li>
        <li><a href="../view/dbms3.html"><i class="fa fa-users">About Us</i></a></li>
        <li><a href="loginController.php?r=logout"><i class="fa fa-sign-out">Logout</i></a></li>
        </ul>
    </div>

	<h1 align = "center">Create/Edit Jobs</h1>
	<div class = "form_wrapper">
    	<form method="post" action="<?=$url?>">
    		<div class="row">
    			<div class="lbl">
        			<label for="jobname">Job Name:</label>
        		</div>
				<div class="field">
            		<input type="text" id="jobname" name="jobname" placeholder="JobName" autofocus value="<?=@$data['JOBNAME']?>">
            		<div class="error"><?= @$error['jobname']?></div>
        		</div>
			</div>


    		<div class="row">
    			<div class="lbl">
    				<label for="jobdesc">Job description:</label>
    			</div>
    			<div class="field">
        			<textarea id="jobdesc" name="jobdesc" rows="4" cols="50"><?=@$data['JOBDESC']?></textarea>
        			<div class="error"><?= @$error['jobdesc']?></div>
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
        			<label for="skills">Skills Required:</label>
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

    		<div class="row">
    			<div class="lbl">
        			<label for="vacancy">Vacancy:</label>
        		</div>
        		<div class="field">
            		<input type="number" id="vacancy" name="vacancy" value="<?=@$data['VACANCY'] == 0 ? '':@$data['VACANCY'];?>">
            		<div class="error"><?= @$error['vacancy']?></div>
        		</div>
    		</div>

    		<div class="row">
    			<div class="lbl">
        			<label for="dateofopen">Date of open:</label>
        		</div>
        		<div class="field">
            		<input type="date" id="dateofopen" name="dateofopen" value="<?=@$data['DATEOFOPEN']?>">
            		<div class="error"><?= @$error['dateofopen']?></div>
        		</div>
    		</div>

    		<div class="row">
    			<div class="lbl">
        			<label for="dateofclose">Date of close:</label>
        		</div>
        		<div class="field">
            		<input type="date" id="dateofclose" name="dateofclose" value="<?=@$data['DATEOFCLOSE']?>">
            		<div class="error"><?= @$error['dateofclose']?></div>
        		</div>
    		</div>

    		<div class="row">
    			<div class="lbl">
        		<label>Status:</label>
        		</div>
        		<div class="field">
            		<div class="radio">
            		<input type="radio" id="active" name="status" value="active" <?= @$data['STATUS']=='active' ? 'checked = "checked"':'' ;?>>
            		<label for="active">Active</label>
            		</div>
            		<div class="radio">
            		<input type="radio" id="inactive" name="status" value="inactive" <?= @$data['STATUS']=='inactive' ? 'checked = "checked"':'' ;?>>
            		<label for="inactive">Inactive</label>
            		</div>
            		<div class="radio">
            		<input type="radio" id="disable" name="status" value="disable" <?= @$data['STATUS']=='disable' ? 'checked = "checked"':'' ;?>>
            		<label for="disable">Disable</label>
            		</div>
	        		<div class="error"><?= @$error['status']?></div>
        		</div>
    		</div>

			<div class="row">
				<div class="lbl">&nbsp;</div>
				<div class="field">
					<div class="error"><?= @$error['date']?></div>
				</div>
			</div>

			<br>
            <div class="btn">
        		<input type="submit" name="savejob" value="Save">
        		<a href="companyController.php">Exit</a>
        	</div>
    	</form>
    </div>
</body>
</html>