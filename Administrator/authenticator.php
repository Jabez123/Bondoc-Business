<!DOCTYPE html>
<html>
<head>
	<title>Authentication 1</title>
	<link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="DIST/css/authenticator.css">
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
                                        <button class="btn btn-lg btn-default btn-block" type="submit" name="back">Go back</button>
                                    </fieldset>
                                </form>
                                <?php 
                                	if (isset($_POST['submit'])) {
                                		$username = $_POST['username'];
                                		$password = $_POST['password'];

                                		if ($username == "Jabez" && $password == "123") {
                                			header("Location: authenticator2.php");
                                		}
                                		else {
                                			echo '<div class="alert alert-danger text-center">
 														Wrong Username or Password
												</div>';
                                		}
                                	}
                                    if (isset($_POST['back'])) {
                                        header("Location: ../index.php");
                                    }
                                 ?>
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