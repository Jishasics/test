<?php
include_once('db_functions.php');

$obj = new Database();

if (!empty($_POST['save'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $dob = trim($_POST['dob']);

    $sql = $obj->register($firstname, $lastname, $email, $password, $dob);
    if ($sql) {
        echo "<script>alert('Registration successfull.');</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Signup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal" action='' method="POST" autocomplete="off" >
                        
                        <div align="center">
                            <h3 class="">Register</h3>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label>First Name:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Enter your first name..." id="firstname" name="firstname" autocomplete="off">
                                <span style="color:red;" id="firstname_error"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Last Name:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name..." autocomplete="off">
                                <span style="color:red;" id="lastname_error"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Date Of Birth:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" id="dob" name="dob" class="form-control" placeholder="" autocomplete="off">
                                <span style="color:red;" id="dob_error"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label>E-mail:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email..." autocomplete="off" onkeyup="checkuseremail(this.value)">
                                <span  style="color:red;" id="email_error"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Password:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" id="password" name="password" class="form-control"  autocomplete="off">
                                <span style="color:red;" id="password_error"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Confirm Password:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" id="conpassword" name="conpassword" class="form-control"  autocomplete="off">
                                <span style="color:red;" id="conpassword_error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-6">
                                <button class="btn btn-success" type="submit" id="save" name="save" value="submit" onclick="return(validate());" >Register</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-5">
                                Already have an account ?<a href="#">Sign in</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> 
        <script src="assets/js/jquery2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script>
            function checkuseremail(email) 
            {
                $.ajax({
                    type: "POST",
                    url: "check_useremail_availability.php",
                    data: 'useremail=' + email,
                    success: function (data) {
                        $("#email_error").html(data);
                    }
                });
            }
            function emailValidation(email)  
            {  
                var emailexp = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;  
                if (email.match(emailexp)){  
                        return true;  
                } else{  
                    $('#email_error').html("* Enter valid email.");
                    return false;
                }  
            } 
            function validate() {
                $('#firstname_error').html(""); 
                $('#lastname_error').html("");
                $('#dob_error').html(""); 
                $('#email_error').html("");
                $('#password_error').html(""); 
                $('#conpassword_error').html("");
                
                var flag = true;
                var first_name = $('#firstname').val();
                var last_name = $('#lastname').val();
                var dob = $('#dob').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var confirmpassword = $('#conpassword').val();
                
                if (email!=''){
                    flag = emailValidation(email);
                }
                if (first_name=='' || first_name==null){
                    flag=false;
                    $('#firstname_error').html("* Please enter first name."); 
                }
                if (last_name==''){
                    flag=false;
                    $('#lastname_error').html("* Please enter last name."); 
                }
                if (dob==''){
                    flag=false;
                    $('#dob_error').html("* Please enter date of birth."); 
                }
                if (email==''){
                    flag=false;
                    $('#email_error').html("* Please enter email."); 
                }
                if (password==''){
                    flag=false;
                    $('#password_error').html("* Please enter password."); 
                }
                if (confirmpassword==''){
                    flag=false;
                    $('#conpassword_error').html("* Please enter confirm password."); 
                }
                if (password != confirmpassword){
                    flag=false;
                    $('#conpassword_error').html("* Confirm password don't match.");
                }
                if(password.length < 6){
                    flag=false;
                    $('#password_error').html("* you have to enter at least 6 characters."); 
                }
                
                if (flag==false){
                    return false;
                } else {
                    return true;
                }
            }

        </script>
    </body>
</html>
