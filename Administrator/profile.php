<?php 
  require_once('dbinfo.inc.php');
  session_start();
  if (!isset($_SESSION['username'])){
      echo "Please login <a href='authenticator.php'>here</a>";
  }
  $conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
  oci_set_client_identifier($conn, $_SESSION['username']);
  $username = htmlentities($_SESSION['username'],ENT_QUOTES);
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Jabez Joshua G. Bondoc">
	<meta name="keyword" content="CS351 IT341">
	<meta http-equiv="refresh" content="120">
	<title>Administrator Monitoring</title>
	<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="DIST/css/admin1.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/modal.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" type="text/css" href="DIST/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/font-awesome.min.css">
    <script src="DIST/js/modal.js"></script>
    <script language="javascript" type="text/javascript">
        function myFunction() {
            var cond = confirm("Are you sure");
            if (cond === true) {
                window.location = "delete.php";
            }
        }
    </script>
</head>
<body style="background-color: white;">
	<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="padding-bottom: 10px;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="padding-top: 20px;">Bondoc-Business Apartment</a>
        </div>
        
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a style="background-color: white;" href="index.php"><i class="fa fa-fw fa-laptop"></i> Dashboard </a>
                </li>
                <li>
                    <a href="add.php"><i class="fa fa-fw fa-user"></i> Add Tenants</a>
                </li>
								<li>
                    <a href="unit.php"><i class="fa fa-fw fa-home"></i> Add Units </a>
                </li>
                <li>
                    <a href="../index.php"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

		<div id="page-wrapper">

		            <div class="container-fluid">
		            <br>
		            <br>
		            <br>
		            <br>
    <?php
      $conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
      $token = $_REQUEST['id_token'];
      $s = oci_parse($conn, "select * from tenants where t_id='".$token."'");
      oci_execute($s);
      while (($row = oci_fetch_array($s, OCI_ASSOC)) != false) {
        $firstname = $row['FIRSTNAME'];
        $middlename = $row['MIDDLENAME'];
        $lastname = $row['LASTNAME'];
        $mobile_number = $row['MOBILE_NUMBER'];
        $unit = $row['UNIT'];
        $monthly_fee = $row['MONTHLY_FEE'];
        $date_started = $row['DATE_STARTED'];
        $due_date = $row['DUE_DATE'];
      }
     ?>
     	<div class="col-md-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Profile</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Firstname:</td>
                        <td><?php echo $firstname; ?></td>
                      </tr>
                      <tr>
                        <td>Middlename:</td>
                        <td><?php echo $middlename; ?></td>
                      </tr>
                      <tr>
                        <td>Lastname:</td>
                        <td><?php echo $lastname; ?></td>
                      </tr>
                         <tr>
                             <tr>
                        <td>Mobile Number:</td>
                        <td>0<?php echo $mobile_number; ?> <button type="button" class="btn-sm btn-info pull-right" onclick="window.location = '#'">Send SMS</button></td>
                      </tr>
                        <tr>
                        <td>Unit:</td>
                        <td><?php echo $unit; ?></td>
                      </tr>
                      <tr>
                        <td>Date Started:</td>
                        <td><?php echo $date_started; ?> <button type="button" class="btn-sm btn-info pull-right" onclick="window.location = 'update_datestarted.php?id_token=<?php echo $token; ?>'">Change</button></td>
                      </tr>
                        <td>Due Date:</td>
                        <td><?php echo $due_date; ?> <button type="button" class="btn-sm btn-info pull-right" onclick="window.location = 'update_duedate.php?id_token=<?php echo $token; ?>'">Change</button>
                        </td>
                      </tr>
                      <tr>
                      	<td>Monthly Fee:</td>
                      	<td><?php echo $monthly_fee; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
                <button class="btn btn-info" type="button" onclick="window.location = 'index.php'">Back</button>
                <button class="btn btn-default pull-right" type="button" onclick="window.location = 'update.php?id_token=<?php echo $token; ?>'">Edit Profile</button>
                <button style="margin-right: 20px;" class="btn btn-danger pull-right" type="button" onclick="myFunction()">Remove</button>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>

  </div>
</div>
	<!-- jQuery -->
    <script src="DIST/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="DIST/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="DIST/js/admin.js"></script>
</body>
</html>
