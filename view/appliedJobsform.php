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

<h2><b>LIST OF MY APPLIED JOBS</b></h2>
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
    <th style="text-align: center;" ><b>COMPANY NAME</b></th>
    <th style="text-align: center;" ><b>APPLIED ON</b></th>
    <th style="text-align: center;" ><b>JOB STATUS</b></th>
    <th style="text-align: center;" ><b>VIEWED(COMPANY)</b></th>
    <th style="text-align: center;" ><b>COMPANY RESPONSE</b></th>
    <th style="text-align: center;" ><b>PHONE</b></th>
    <th style="text-align: center;" ><b>ACT</b></th>
  </tr>
  </thead>

  <tbody>
  <?php foreach($data as $key=>$value):?>
  	<tr>
  		<td><?= $key+1?></td>
  		<td><?= $value['JOBNAME']?></td>
  		<td><?= $value['CMPNAME']?></td>
  		<td><?= $value['APPLIEDON']?></td>
  		<td><?= $value['USERSTATUS'] == 1 ? "APPLIED" : "CANCELLED"?></td>
  		<td><?= $value['VIEWED'] == 1 ? "VIEWED" : "NOT VIEWED"?></td>
  		<td><?php IF($value['SELECTION_STATUS'] == 1)echo "ACCEPTED";
  		          ELSE IF($value['SELECTION_STATUS'] == -1)echo "REJECTED";
  		          ELSE echo "NIL";
  		    ?>
  		</td>
  		<?php if($value['SELECTION_STATUS'] == 1):?>
  			<td><?= $value['PHONE']?></td>
  		<?php else:?>
  			<td title="Available when accepted">-</td>
  		<?php endif;?>
  		<td><button type="button" class="btn1 <?=$value['USERSTATUS']!=1 && $value['SELECTION_STATUS']!=1 ? "disabled" : "" ?>"
  		onclick="cancelJob(this);" data-aid="<?=$value['AID']?>">Cancel</button></td>
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
       	$('.b').addClass('active');
       	$('.a').removeClass('active');
    });

    function cancelJob(me)
    {
    	isdisabled = $(me).hasClass('disabled');
    	if(!isdisabled){
			aid = $(me).attr('data-aid');
    		location.href='employeeController.php?r=cancel&aid='+aid;
    	}
    }
</script>
</html>