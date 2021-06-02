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
        <li><a href="companyController.php?r=profile"><i class="fa fa-user">My Profile</i></a></li>
        <li><a href="companyController.php"><i class="fa fa-home">Home</i></a></li>
        <li><a href="../view/dbms3.html"><i class="fa fa-users">About Us</i></a></li>
        <li><a href="loginController.php?r=logout"><i class="fa fa-sign-out">Logout</i></a></li>
        </ul>
    </div>

<h2><b>List of Jobs</b></h2>

<br>
<div class="sub-menu">
	<ul>
		<li class="a"><a href="companyController.php">My Jobs</a></li>
		<li class="b"><a href="companyController.php?r=updateCandidate">Responses</a></li>
		<li><a href="companyController.php?r=newJob"><i class="fa fa-plus">  New Job</i></a></li>
	</ul>
</div>
<div class = "btn">

</div>

<br>

<div class="cmp-container">
<table id="cmp">
  <thead>
  <tr>
  	<th style="text-align: center;" ><b>S.NO</b></th>
    <th style="text-align: center;" ><b>JOBNAME</b></th>
    <th style="text-align: center;" ><b>JOB DESCRIPTION</b></th>
    <th style="text-align: center;" ><b>EDUCATION</b></th>
    <th style="text-align: center;" ><b>SKILLS</b></th>
    <th style="text-align: center;" ><b>VACANCY</b></th>
    <th style="text-align: center;" ><b>OPEN DATE</b></th>
    <th style="text-align: center;" ><b>CLOSE DATE</b></th>
    <th style="text-align: center;" ><b>STATUS</b></th>
    <th style="text-align: center;" ><b>EXP</b></th>
    <th style="text-align: center;" ><b>ACT</b></th>
  </tr>
  </thead>

  <tbody>
  <?php foreach($data as $key=>$value):?>
  	<tr>
  		<td><?= $key+1?></td>
  		<td><?= $value['JOBNAME']?></td>
  		<td><?= $value['JOBDESC']?></td>
  		<td><?= $value['EDUCATION']?></td>
  		<td><?= $value['SKILLS']?></td>
  		<td><?= $value['VACANCY']?></td>
  		<td><?= $value['DATEOFOPEN']?></td>
  		<td><?= $value['DATEOFCLOSE']?></td>
  		<td><?= strtoupper($value['STATUS'])?></td>
  		<td><?= $value['EXPERIENCE']?></td>
  		<td><a href="companyController.php?r=editJob&job=<?=$value['JID'];?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
  	</tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>


<br>
</body>
<script type="text/javascript">
	$(document).ready(function () {
        $('#cmp').DataTable({
        	"autoWidth" : false,
            "columns": [
                { "width": "20px" },
                { "width": "70px" },
                { "width": "70px" },
                { "width": "20px" },
                { "width": "20px" },
                { "width": "20px" },
                { "width": "20px" },
                { "width": "20px" },
                { "width": "20px" },
                { "width": "20px" },
                { "width": "10px" }
        	],
        	"columnDefs": [
        		{"orderable" : false , "targets" : -1}
        	]
        });
    	$('.a').addClass('active');
       	$('.b').removeClass('active');
    });
</script>
</html>
