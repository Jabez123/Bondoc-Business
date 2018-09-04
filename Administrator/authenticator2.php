<!DOCTYPE html>
<html>
<head>
    <title>Authenticator 2</title>
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/authenticator.css">
    <link rel="stylesheet" type="text/css" href="DIST/css/bootstrap-pincode-input.css">
     <style>
        body{

        }
    </style>
    <script type="text/javascript" src="DIST/js/jquery-2.2.4.js"></script>
    <script type="text/javascript" src="DIST/js/bootstrap-pincode-input.js"></script>
    <script type="text/javascript" src="DIST/js/authenticator.js"></script>
    <script>
        $(document).ready(function() {
            $('#pincode-input1').pincodeInput({hidedigits:false,complete:function(value, e, errorElement){
                
                $("#pincode-callback").html("This is the 'complete' callback firing. Current value: " + value);
                
                // check the code
                if(value!="1379"){
                    $(errorElement).html("The code is not correct.");
                }else{
                    alert('code is correct!');
                    window.location.href = "index.php";
                }
                
            }});
            $('#pincode-input4').pincodeInput({hidedigits:false,inputs:4});
            $('#pincode-input3').pincodeInput({hidedigits:false,inputs:5});
            $('#pincode-input2').pincodeInput({hidedigits:false,inputs:6,complete:function(value, e, errorElement){
                $("#pincode-callback").html("Complete callback from 6-digit test: Current value: " + value);
            }});
            
            
        });
    </script>
</head>
<body>
    <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                    <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body text-center">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <input type="text" id="pincode-input1"  >
                                    <div>
                                    <button class="btn btn-default" href="#" onclick="javascript:$('#pincode-input1').pincodeInput().data('plugin_pincodeInput').clear()">clear</button>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
</body>
</html>