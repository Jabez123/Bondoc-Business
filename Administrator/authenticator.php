<?php 
    require_once('dbinfo.inc.php');
    session_start();

    function login_form($message)
    {
        echo <<<EOD
        <!DOCTYPE html>
<html>
<head>
    <title>Authentication 1</title>
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/authenticator.css">
    <script language="javascript" type="text/javascript">
        function myFunction() {
            window.location = "../index.php";
        }
    </script>
</head>
<body>
    <!--
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.
-->
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row-fluid user-row">
                                    <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form accept-charset="UTF-8" role="form" class="form-signin" action="#" method="post">
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Username" id="username" name="username" type="text">
                                        <input class="form-control" placeholder="Password" id="password" name="password" type="password">
                                        <br></br>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" id="login" value="Login »">
                                        <button class="btn btn-lg btn-default btn-block" type="button" onclick="myFunction()">Go back</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
            <script type="text/javascript" src="DIST/js/authenticator.js"></script>
</body>
</html>
EOD;
    }
    if (!isset($_POST['username']) || !isset($_POST['password'])){
        login_form('Welcome');
    }else{
        // Check validity of the supplied username & password
        $conn = oci_pconnect(ORA_CON_UN,ORA_CON_PW,ORA_CON_DB);
        oci_set_client_identifier($conn, 'Admin');
        
        $s = oci_parse($conn, 'select username, password from bondoc_business_admin.authentication where username=:username and password = :password');
        oci_bind_by_name($s, ":username", $_POST['username']);
        oci_bind_by_name($s, ":password", $_POST['password']);
        oci_execute($s);
        $r = oci_fetch_array($s, OCI_ASSOC);
        
        if ($r){
            // The password matches: the user can use the application.
            
            // Set the username to be used as the client identifier in future HTTP requests:
            $_SESSION['username'] = $_POST['username'];
            
            echo <<<EOD
<!DOCTYPE html>
<html>
<head>
    <title>Authentication 1</title>
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/authenticator.css">
    <script language="javascript" type="text/javascript">
        function myFunction() {
            window.location = "../index.php";
        }
    </script>
</head>
<body>
    <!--
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.
-->
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row-fluid user-row">
                                    <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-success text-center">
                                                    Authentication success! Please <a href="authenticator2.php">proceed</a>
                                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
            <script type="text/javascript" src="DIST/js/authenticator.js"></script>
</body>
</html>
EOD;
        }
        else{
            // No rows matched so login failed
            echo <<<EOD
        <!DOCTYPE html>
<html>
<head>
    <title>Authentication 1</title>
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/authenticator.css">
    <script language="javascript" type="text/javascript">
        function myFunction() {
            window.location = "../index.php";
        }
    </script>
</head>
<body>
    <!--
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.
-->
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row-fluid user-row">
                                    <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form accept-charset="UTF-8" role="form" class="form-signin" action="#" method="post">
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Username" id="username" name="username" type="text">
                                        <input class="form-control" placeholder="Password" id="password" name="password" type="password">
                                        <br></br>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" id="login" value="Login »">
                                        <button class="btn btn-lg btn-default btn-block" type="button" onclick="myFunction()">Go back</button>
                                        <div class="alert alert-danger text-center">
                                                Wrong username or password.
                                            </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
            <script type="text/javascript" src="DIST/js/authenticator.js"></script>
</body>
</html>
EOD;
        }
    }
   
 ?>


