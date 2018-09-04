<?php 
  require_once('dbinfo.inc.php');
  session_start();
  if (!isset($_SESSION['username'])){
      echo "Please login <a href='authenticator.php'>here</a>";
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Jabez Joshua G. Bondoc">
    <meta name="keyword" content="CS351 IT341">
    <title>Add Tenant</title>
    <!-- Bootstrap Core CSS -->
      <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="DIST/css/admin1.css">
      <!-- Font-awesome CSS -->
      <link rel="stylesheet" type="text/css" href="DIST/css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="DIST/css/font-awesome.min.css">
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
                      <a href="index.php"><i class="fa fa-fw fa-laptop"></i> Dashboard </a>
                  </li>
                  <li>
                      <a style="background-color: white;" href="add.php"><i class="fa fa-fw fa-user"></i> Add Tenants</a>
                  </li>
  								<li>
                      <a href="add_unit.php"><i class="fa fa-fw fa-home"></i> Add Units </a>
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

  		                <!-- Page Heading -->
  		                <div class="row">
  											<br>
  											<br>
  		                    <div class="col-lg-12">
  		                        <h1 class="page-header">
  		                            Add Tenant
  		                        </h1>
  		                    </div>
  		                </div>
  		                <!-- /.row -->

  		                <div class="row">
  		                    <div class="col-md-12">
                                <div class="col-md-5">
                                    <form role="form" action="#" method="post">
                                    <div class="well bs-component">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" name="firstname" />
                                        </div>
                                        <div class="form-group">
                                            <label>Middlename</label>
                                            <input type="text" class="form-control" name="middlename" />
                                        </div>
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" class="form-control" name="lastname" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="tel" class="form-control" name="mobile_number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <div class="well bs-component">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="unit" class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Monthly Fee</label>
                                            <input type="number" class="form-control" min="0" name="monthly_fee" />
                                        </div>
                                        <div class="form-group">
                                            <label>Date Started</label>
                                            <input type="date" class="form-control" name="date_started" />
                                        </div>
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" class="form-control" name="due_date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="submit" name="add" class="btn btn-success">Submit Button</button>
                                    <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                    <?php
                                        if (isset($_POST['add'])) {
                                            $conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
                                            $firstname = $_POST['firstname'];
                                            $middlename = $_POST['middlename'];
                                            $lastname = $_POST['lastname'];
                                            $mobile_number = $_POST['mobile_number'];
                                            $unit = $_POST['unit'];
                                            $monthly_fee = $_POST['monthly_fee'];
                                            $date_started = $_POST['date_started'];
                                            $due_date = $_POST['due_date'];
                                            
                                            do_query($conn, "INSERT INTO TENANTS(FIRSTNAME, MIDDLENAME, LASTNAME, MOBILE_NUMBER, UNIT, MONTHLY_FEE, DATE_STARTED, DUE_DATE)
                                            VALUES 
                                            ('".$firstname."',
                                            '".$middlename."',
                                            '".$lastname."',
                                            '".$mobile_number."',
                                            '".$unit."',
                                            '".$monthly_fee."',
                                            TO_DATE('".$date_started."', 'yyyy/mm/dd'),
                                            TO_DATE('".$due_date."', 'yyyy/mm/dd'))
                                            ");
                                            
                                        }
                                    function do_query($conn, $query) {
                                        $stid = oci_parse($conn, $query);
                                        $r = oci_execute($stid);

                                        if (!$r) {
                                            echo '<div class="alert alert-danger text-center">
                                                Adding Failed.
                                            </div>';
                                        }
                                        else {
                                            echo '<div class="alert alert-success text-center">
                                                    Adding success! See <a href="index.php">here</a>
                                                        </div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-4"></div>
						    </div>
  		                </div>
  		                <!-- /.row -->

  		            </div>
  		            <!-- /.container-fluid -->
  		        </div>
              <!-- /.row -->
  	<!-- jQuery -->
      <script src="DIST/js/jquery.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="DIST/js/bootstrap.min.js"></script>

      <!-- Custom JS -->
      <script type="text/javascript" src="DIST/js/admin.js"></script>
  </body>
</html>
