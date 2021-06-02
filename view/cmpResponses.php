<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="/favicon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="../datatable/datatables.css">
	<link rel="stylesheet" href="../view/empHome.css">
	<link rel="stylesheet" href="../view/menu.css">

	<script type="text/javascript" src="../assets/jquery/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../assets/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../datatable/datatables.js"></script>
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

<h2><b>RESPONSES FROM USERS</b></h2>
<br>

<div class="sub-menu">
	<ul>
		<li class="a"><a href="companyController.php">Jobs Available</a></li>
		<li class="b"><a href="companyController.php?r=cancel">My applied jobs</a></li>
		<li><a href="companyController.php?r=newJob"><i class="fa fa-plus">  New Job</i></a></li>
	</ul>
</div>
<br>
<table id="cmp">
  <thead>
  <tr>
  	<th style="text-align: center;" ><b>S.NO</b></th>
    <th style="text-align: center;" ><b>JOBNAME</b></th>
    <th style="text-align: center;" ><b>CANDIDATE NAME</b></th>
    <th style="text-align: center;" ><b>EDUCATION</b></th>
    <th style="text-align: center;" ><b>RESUME</b></th>
    <th style="text-align: center;" ><b>MORE DETAILS</b></th>
    <th style="text-align: center;" ><b>SELECT STATUS</b></th>
    <th style="text-align: center;" ><b>ACT</b></th>
  </tr>
  </thead>

  <tbody>
  <?php foreach($data as $key=>$value):?>
  	<tr>
  		<td><?= $key+1?></td>
  		<td><?= $value['JOBNAME']?></td>
  		<td><?= $value['FNAME']?></td>
  		<td><?= $value['EDUCATION']?></td>
  		<td><a target="_blank" href="employeeController.php?r=profileddownload&uid=<?= @$value['ID'] ?>" style="text-decoration:none;">
  		Resume</a></td>
  		<td><div onclick="getuserdetails(this);" data-uid="<?= @$value['ID']?>" data-aid="<?= @$value['AID']?>" style="cursor:pointer">CLICK HERE</div></td>
  		<td>
  			<?php if($value['SELECTION_STATUS'] == 1) echo "ACCEPTED";
                  elseif ($value['SELECTION_STATUS'] == -1) echo "REJECTED";
                  else echo "NIL";
            ?>
  		</td>
  		<td>
  		<?php IF($value['SELECTION_STATUS'] != -1):?>
  				<?php if($value['SELECTION_STATUS'] == 0):?>
  				<button type="button" class="btn1" onclick="acceptUser(this);" data-aid="<?=$value['AID']?>">ACCEPT</button>
  				<?php endif;?>
  				<button type="button" class="btn1" onclick="rejectUser(this);" data-aid="<?=$value['AID']?>">REJECT</button>
  		<?php ENDIF;?>
  		</td>
  	</tr>
  <?php endforeach;?>
  </tbody>
</table>
<div id="sDialog"></div>
<br>
</body>
<script type="text/javascript">
	$(document).ready(function () {
        $('#cmp').DataTable();
        if("<?= @$error['message']?>" != ""){
        	alert("<?= @$error['message']?>");
       	}
       	$('.b').addClass('active');
       	$('.a').removeClass('active');
    });

    function acceptUser(me)
    {
		if(confirm("Confirm to accept the candidate")){
			aid = $(me).attr('data-aid');
    		location.href='companyController.php?r=updateCandidate&aid='+aid+'&s=1';
    	}
	}
	function rejectUser(me)
    {
		if(confirm("Confirm to reject the candidate")){
			aid = $(me).attr('data-aid');
    		location.href='companyController.php?r=updateCandidate&aid='+aid+'&s=-1';
    	}
	}
	function getuserdetails(me)
	{
		uid = $(me).attr('data-uid');
		aid = $(me).attr('data-aid');
		$.ajax({
			url:'companyController.php?r=getUserDetails&uid='+uid+'&aid='+aid,
			dataType:"JSON",

		}).done(function( data ) {

			/*data = {'status' : true,
					'template': '...',
					'message' : ''
					}*/
			if (data.status) {
				$('#sDialog').html(data.template);
				$('#sDialog').dialog({
					title:"User details",
					width:500,
					buttons: {
                 	 	OK: function() {$(this).dialog("close");}
               		},
				});
			}else {
				$('#sDialog').html(data.message);
				$('#sDialog').dialog();
			}

        });
  }
</script>
</html>