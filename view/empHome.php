<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="/favicon.png">
	<link rel="stylesheet" href="../view/empHome.css">
	<link rel="stylesheet" href="../view/menu.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../datatable/datatables.css">

	<script type="text/javascript" src="../assets/jquery/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../datatable/datatables.js"></script>
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

<h2><b>LIST OF JOBS</b></h2>
<br>
<div class="sub-menu">
	<ul>
		<li class="a"><a href="employeeController.php">Jobs Available</a></li>
		<li class="b"><a href="employeeController.php?r=cancel">My applied jobs</a></li>
	</ul>
</div>
<br>
<table id="job">
  <thead>
  <tr>
  	<th style="text-align: center;" ><b>S.NO</b></th>
    <th style="text-align: center;" ><b>JOBNAME</b></th>
    <th style="text-align: center;" ><b>JOB DESCRIPTION</b></th>
    <th style="text-align: center;" ><b>COMPANY NAME</b></th>
    <th style="text-align: center;" ><b>EDUCATION</b></th>
    <th style="text-align: center;" ><b>SKILLS</b></th>
    <th style="text-align: center;" ><b>EXP</b></th>
    <th style="text-align: center;" ><b>VACANCY</b></th>
    <th style="text-align: center;" ><b>CLOSE DATE</b></th>
    <th style="text-align: center;" ><b>ACT</b></th>
  </tr>
  </thead>

  <tbody>
  <?php foreach($data as $key=>$value):?>
  	<tr>
  		<td><?= $key+1?></td>
  		<td><?= $value['JOBNAME']?></td>
  		<td><?= $value['JOBDESC']?></td>
  		<td><?= $value['CMPNAME']?></td>
  		<td><?= $value['EDUCATION']?></td>
  		<td><?= $value['SKILLS']?></td>
  		<td><?= $value['EXPERIENCE']?></td>
  		<td><?= $value['VACANCY']?></td>
  		<td><?= $value['DATEOFCLOSE']?></td>
  		<td><button type="button" class="btn1 <?= @$_SESSION['pro_comp'] == 0 ? "disabled" : ""?>"  onclick="applyJob(this);" data-jid="<?=$value['JID']?>">Apply</button></td>
  	</tr>
  <?php endforeach;?>
  </tbody>
</table>
<br>
</body>
<script type="text/javascript">
	$(document).ready(function () {
        $('#job').DataTable();
        if("<?= @$error['message']?>" != ""){
        	alert("<?= @$error['message']?>");
       	}
       	$('.a').addClass('active');
       	$('.b').removeClass('active');
    });

    function applyJob(me){
    	isdisabled = $(me).hasClass('disabled');
    	if(isdisabled){
			alert("Please update your profile with all essential information so that you can apply for the job");
    	}else{
    		jid = $(me).attr('data-jid');
    		location.href='employeeController.php?r=apply&jid='+jid;
    	}
    }
</script>
</html>
