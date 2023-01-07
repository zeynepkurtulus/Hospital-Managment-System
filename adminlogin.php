<?php
    session_start(); 
    include "include/config.php";

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $error = array(); 
        if (empty($username)) {
            $error['admin'] = "Please enter username"; 
        }
        else if (empty($password)) {
            $error['admin'] = "Please enter password";
        }
        if (count($error)== 0) {
            $query = "SELECT * FROM admin WHERE username = '$username' AND userpass = '$password' ";
            $result =  mysqli_query($connect,$query); 

            if (mysqli_num_rows($result) == 1) {
                echo "<script> alert('Login Successfull')</script >";
                $_SESSION['admin'] = $username;
                header("Location:admin/index.php");
                exit();
            }
            else{
                echo "<script> alert('Invalid Username or Password')</script >";
            }
         }
        
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel </title>
</head>
<body style= "background-image: url(img/back.jpeg)">

    <?php

        include ("include/header.php");
    ?> 


    <div style= "margin-top: 60px;"> </div>

    <div class= "container">
        <div class= "col-md-12">
            <div class= "row">
                 <div class= "col-md-3"></div>
                 <div class= "col-md-6 jumbotron">
                    <img src="img/admin.png" class= "col-md-12" style= "width: 20%; margin-left: 185px; margin-top: 0px">
                     <form action="" method="post" class= "my-2"> 

                            <div>
                                <?php
                                    if (isset($error['admin'])) {
                                        $sh = $error['admin']; 
                                        $show = "<h4 class = 'alert alert-danger'>$sh</h4>";
                                    }
                                    else{
                                        $show = "";
                                    }
                                    echo $show;

                                ?>
                            </div>
                        


                        <div class= "form-group">
                            &nbsp;
                            <label> Username </label>
                            <input type="text" name="username" class= "form-control" autocomplete= "off" placeholder=  "Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name= "pass" class= "form-control" placeholder= "Enter Password">
                        </div>
                        <input type="submit" id = "gönder" name= "login" class= "btn btn-success" placeholder = "Submit" value= "Login">
                        <script>document.getElementById("gönder").value = "Submit";</script>
                        
                     </form>
                 </div>
                 <div class= "col-md-3"></div> 
            </div>


         
        </div>





    </div>
    
</body>
</html>