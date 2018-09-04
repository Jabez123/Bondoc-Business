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
		                            Welcome <?php echo $username; ?> to Dashboard
		                        </h1>
														<ol class="breadcrumb">
                            	<li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard Tenants
                            	</li>
                        		</ol>
		                    </div>
		                </div>
		                <!-- /.row -->

		                <div class="row">
							<div class="col-md-12">
		                        <div class="table-responsive">
		                            <?php
                                    $c = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
                                    $s = oci_parse($c, "select T_ID, FIRSTNAME, DATE_STARTED, DUE_DATE from TENANTS");
                                    oci_execute($s);
                                    echo "<table class='table table-bordered table-hover'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    $ncols = oci_num_fields($s); //Fields == Columns
                                    for ($i=1; $i <= $ncols; ++$i) { //$s = SQL, $i = Column
                                        $colname = oci_field_name($s, $i);
                                        echo "<th class='info'>".htmlentities($colname,ENT_QUOTES)."</th>";
                                    }
                                    echo "<th class='info'>Action</th>";
                                    echo "</tr></thead>";				//$s = SQL
                                    echo "<tbody>";
                                    while (($row = oci_fetch_array($s,OCI_ASSOC+OCI_RETURN_NULLS))!=FALSE) { // Rows
                                        echo "<tr>";
                                        foreach ($row as $item) {
                                            echo "<td>".($item!==null?htmlentities($item,ENT_QUOTES):"&nbsp;")."</td>";
                                        }
                                        echo "<td><a href='profile.php?id_token=".$row["T_ID"]."'>View more</a></td>";
                                        echo "</tr></tbody>";
                                    }
                                    echo "</table>";
                                    ?>
		                        </div>
				            </div>
		                </div>
		                <!-- /.row -->

		            </div>
		            <!-- /.container-fluid -->
								<div class="container-fluid">

		                <!-- Page Heading -->
		                <div class="row">
		                    <div class="col-lg-12">
														<ol class="breadcrumb">
                            	<li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard Units
                            	</li>
                        		</ol>
		                    </div>
		                </div>
		                <!-- /.row -->
										<!-- DIVISION FOR UNITS -->
		                <div class="row">
											<div class="col-md-12">
		                        <div class="table-responsive">
		                            <?php
                                    $c = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
                                    $s = oci_parse($c, "select * from building");
                                    oci_execute($s);
                                    echo "<table class='table table-bordered table-hover'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    $ncols = oci_num_fields($s); //Fields == Columns
                                    for ($i=1; $i <= $ncols; ++$i) { //$s = SQL, $i = Column
                                        $colname = oci_field_name($s, $i);
                                        echo "<th class='info'>".htmlentities($colname,ENT_QUOTES)."</th>";
                                    }
                                    echo "<th class='info'>Action</th>";
                                    echo "</tr></thead>";       //$s = SQL
                                    echo "<tbody>";
                                    while (($row = oci_fetch_array($s,OCI_ASSOC+OCI_RETURN_NULLS))!=FALSE) { // Rows
                                        echo "<tr>";
                                        foreach ($row as $item) {
                                            echo "<td data-toggle='modal' data-target='#modaltenant'>".($item!==null?htmlentities($item,ENT_QUOTES):"&nbsp;")."</td>";
                                        }
                                        echo "<td><a href='update_unit.php?id_token=".$row["B_ID"]."'>Change</a></td>";
                                        echo "</tr></tbody>";
                                    }
                                    echo "</table>";
                                    ?>
		                        </div>
													</div>
		                </div>
		                <!-- /.row -->

		            </div>

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
