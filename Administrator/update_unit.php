<?php 
  require_once('dbinfo.inc.php');
  session_start();
  if (!isset($_SESSION['username'])){
      echo "Please login <a href='authenticator.php'>here</a>";
  }
  $conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
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
      $s = oci_parse($conn, "select * from building where b_id='".$token."'");
      oci_execute($s);
      while (($row = oci_fetch_array($s, OCI_ASSOC)) != false) {
        $unit = $row['UNIT'];
        $description = $row['DESCRIPTION'];
        $status = $row['STATUS'];
        $monthly_fee = $row['MONTHLY_FEE'];
      }
     ?>
     	<div class="col-md-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Update</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                      <form action="#" method="POST">
                    <tbody>
                      <tr>
                        <td>Unit:</td>
                        <td>
                        <input type="text" class="form-control" value="Prev: <?php echo $unit; ?>" readonly="">
                          <select name="unit" class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Description:</td>
                        <td><div class="form-group">
                                <div class="col-lg-10">
                                  <textarea name="description" class="form-control" rows="10" id="textArea" style="margin-top: 0px; margin-bottom: 0px; width: 200px; height: 120px;"><?php echo $description; ?></textarea>
                                </div>
                        </div></td>
                      </tr>
                      <tr>
                        <td>Status:</td>
                        <td>
                          <select name="status" class="form-control">
                                                <option style="background-color: orange"><?php echo $status; ?></option>
                                                <option>Occupied</option>
                                                <option>Not Occupied</option>
                                            </select>
                        </td>
                      </tr>
                         <tr>
                      <tr>
                      	<td>Monthly Fee:</td>
                      	<td><input class="form-control" type="num" name="monthly_fee" value="<?php echo $monthly_fee; ?>"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
                <button class="btn btn-info" type="button" onclick="window.location = 'index.php'">Cancel</button>
                <button class="btn btn-success pull-right" name="update" type="submit">Confirm</button>
            </div>
              <?php
                 if (isset($_POST['update'])) {
                     $conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
                     $token = $_REQUEST['id_token'];
                     $u_unit = $_POST['unit'];
                     $u_description = $_POST['description'];
                     $u_status = $_POST['status'];
                     $u_monthly_fee = $_POST['monthly_fee'];
                     $s = oci_parse($conn, "update building set UNIT='".$u_unit."', DESCRIPTION='".$u_description."',
                            STATUS='".$u_status."', MONTHLY_FEE='".$u_monthly_fee."'
                            where b_id='".$token."'");
                     $r = oci_execute($s, OCI_COMMIT_ON_SUCCESS);
                     
                     if ($r) {
                         echo '<div class="alert alert-success text-center">
                                Change success! Please proceed <a href="index.php">Dashboard</a>
                               </div>';
                     }
                     else {
                         echo '<div class="alert alert-danger text-center">
                                    Edit Failed!
                                    
                            </div>';
                         
                     }
                 }
              ?>
            </form>
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
