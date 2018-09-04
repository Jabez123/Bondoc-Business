<?php 
    require_once('Administrator/dbinfo.inc.php');
    $conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
 ?>
<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bondoc-Business Apartment</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/main.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="DIST/css/scrolling1.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/contact.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/main2.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/jquery.fancybox.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" type="text/css" href="DIST/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/font-awesome.min.css">
    <script language="javascript" type="text/javascript">
      function myAlert() {
      var pick =  confirm("Are you a administrator?");
        if(pick === true){
          window.location.href = "Administrator/authenticator.php";
          return true;
        }
        else {
          return false;
        }
      }
    </script>


<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Bondoc-Business Apartment</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#detail">Unit Details</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#gallery">Gallery</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#location">Location</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
        			    <li class="btn-warning"><a onclick="myAlert()" href="#">
                    <i class="fa fa-user fa-fw"></i>Admininstrator</a></li>
      			    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1>Bondoc-Business Apartment</h1>
                <p>Hi! Welcome visitor.</p>
                <p>If you are looking for nice, safe and quiet resting place then you are in right place.</p>
                <a class="btn btn-primary btn-lg page-scroll" href="#detail">Get Started!</a>
                </div>
                <div class="col-md-3"></div>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.row -->

    </div>
    </section>
    <!-- Unit Detail Section -->
    <section id="detail" class="detail-section">
    <hr>
        <div class="container-fluid">
            <div class="row">
               <div class="jumbotron jumbotron-sm" style="background-color: DimGray;">
                  <h1>Unit Details <img  class="rotate" src="IMAGE/icon/retina.svg" alt="Generic placeholder image"></h1>
               </div>
                <div class="col-lg-12">
                <div class="panel panel-default">
                        <div class="panel-body">
                	<?php 
                        $s = oci_parse($conn, 'select * from building order by UNIT');
                        $r = oci_execute($s);
                        if (!$r) {
                            echo "Error";
                        }
                        while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) !=false) {
                            if ($row["STATUS"] == "Occupied") {
                                echo '
                            <div class="col-lg-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">Unit '.$row["UNIT"].'</div>
                                        <div class="panel-body">
                                            <div class="well well-sm">
                                                <label class="pull-left">Description:</label>
                                                <textarea name="description" class="form-control" rows="10" id="textArea" style="margin-top: 0px; margin-bottom: 0px; height: 120px;" readonly="">'.$row["DESCRIPTION"].'</textarea>
                                                <br>
                                                <label class="pull-left">Monthly fee:</label>
                                                <p>'.$row["MONTHLY_FEE"].'</p>
                                            </div>
                                            <div class="well well-sm">
                                            <label class="pull-left">Status:</label>
                                            <p>'.$row["STATUS"].'</p>
                                            </div>
                                        </div>
                                </div>
                           </div>';
                            }
                            else {
                                echo '
                            <div class="col-lg-4">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">Unit '.$row["UNIT"].'</div>
                                        <div class="panel-body">
                                            <div class="well well-sm">
                                                <label class="pull-left">Description:</label>
                                                <textarea name="description" class="form-control" rows="10" id="textArea" style="margin-top: 0px; margin-bottom: 0px; height: 120px;" readonly="">'.$row["DESCRIPTION"].'</textarea>
                                                <br>
                                                <label class="pull-left">Monthly fee:</label>
                                                <p>'.$row["MONTHLY_FEE"].'</p>
                                            </div>
                                            <div class="well well-sm">
                                            <label class="pull-left">Status:</label>
                                            <p>'.$row["STATUS"].'</p>
                                            </div>
                                        </div>
                                </div>
                           </div>';
                            }
                            
                        }
                     ?>

                    <!-------------------------------------------------------------------------------------->
                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery-section">
      <div class="container-fluid">
        <div class="jumbotron jumbotron-sm" style="background-color: DimGray;">
          <h1>Gallery <img  class="rotate" src="IMAGE/icon/picture.svg" alt="Generic placeholder image"></h1>
        </div>
         <!--####
### How to add in your boostrap project
1) Add jQuery "<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>"
2) Download fancybox (https://github.com/fancyapps/fancyBox)
3) Or use CDN (http://cdnjs.com/libraries/fancybox)
####--!>

<!-- References: https://github.com/fancyapps/fancyBox -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<div class="container">
    <div class="row">
        <div class='list-group gallery'>
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #1">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #2">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #3">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #4">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #5">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #6">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #7">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #8">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #9">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #10">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #11">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #12">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #13">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #14">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #15">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png" data-fancybox="group" data-caption="Caption #16">
                    <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        <small class='text-muted'>Image Title</small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
        </div> <!-- list-group / end -->
    </div> <!-- row / end -->
</div> <!-- container / end -->

    </div>
</div>
    </section>

    <!-- Location Section -->
    <section id="location" class="location-section">
    <hr>
        <div class="container-fluid">
        <div class="jumbotron jumbotron-sm" style="background-color: DimGray;">
          <h1>Location <img  class="rotate" src="IMAGE/icon/map.svg" alt="Generic placeholder image"></h1>
        </div>
        </div>
        <div class="container">
          <div class="col-lg-4" style="padding-left: 50px;">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Our Address</legend>
            <address>
                43 Tiangco Street, Barangay Ibaiba,<br>
                  Malabon City
            </address>
            </form>
          </div>
          <div class="col-md-6">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.8428341165245!2d120.94901281427525!3d14.664859089761544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b45048cec08f%3A0x7883c1dd8e70d784!2sT+Tiangco+St%2C+Malabon%2C+Metro+Manila!5e0!3m2!1sen!2sph!4v1488022924181" width="100%" height="450" frameborder="0" style="border:0"></iframe>
</div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron jumbotron-sm" style="background-color: DimGray;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    Contact us <img class="rotate" src="IMAGE/icon/laptop.svg" alt="Generic placeholder image"></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Subject</label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected="">Choose One:</option>
                                <option value="service">General Customer Service</option>
                                <option value="suggestions">Suggestions</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                            Send Message</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-phone">Contact</span></legend>
            <address>
                <abbr title="Phone">
                    P:</abbr>
                (123) 456-7890 <br>
                <abbr title="Mobile">
                    M:</abbr>
                    09123123123 <br>
            </address>
            <address>
                <strong>E-mail</strong><br>
                <a href="mailto:#">bondoc.business123@gmail.com</a>
            </address>
            </form>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </section>
          <hr>
          <div class="container">
            <footer>
        <p class="footer">&copy; Bondoc-Business Apartment 2017</p>
      </footer>
          </div>
    <!-- jQuery -->
    <script src="DIST/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="DIST/js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="DIST/js/jquery.easing.min.js"></script>
    <script src="DIST/js/scrolling-nav.js"></script>

    <!-- Gallery Javascript -->
    <script type="text/javascript" src="DIST/js/jquery.fancybox.js"></script>
</body>

