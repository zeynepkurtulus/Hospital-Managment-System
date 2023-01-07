<?php

session_start(); 
include "include/config.php";

if(isset($_POST['apply'])) {

    $id = $_POST['id'];
    $doctorname = $_POST['dname'];
    $specialty = $_POST['specialty'];

    $error = array();

    if(empty($id)) {
        $error['apply'] = "Please enter an ID: ";
    }

    else if(empty($dname)) {
        $error['apply'] = "Please enter the doctor name: ";
    }

    else if(empty($specialty)) {
        $error['apply'] = "Please enter the doctor's specialty: ";
    }

    if(count($error) == 0) {
        $query = "INSERT INTO doctor(id,dname,specialty) VALUES('$id', '$doctorname', '$specialty')";
        $result =  mysqli_query($connect,$query); 

        if ($result) {
            echo "<script> alert('Insertion Successfull')</script >";
            header("Location: doctorinsertion.php");
            exit();
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login Page</title>
</head>
<body style="background-image: url(img/back.jpeg);background-size: cover;background-repeat:no-repeat;">

    <?php
        include "include/header.php";
     ?>

    <div class = "container-fluid">
        <div class = "col-md-12">
            <div class = "row">
                <div class = "col-md-3"></div>
                <div class = "col-md-6 jumbotron my-5">
                     <h5 class = "text-center my-2">Doctor Insertion</h5>

                     <form method = "post">
                     <div class = "form-group"> 
                            <label> Doctor ID </label>
                            <input type = "text" name ="id" class = "form-control"
                            autocomplete = "off" placeholder = "Enter ID">
                        </div>

                        <div class = "form-group">
                            <label> Doctor Name </label>
                            <input type = "text" name ="dname" class = "form-control"
                            autocomplete = "off" placeholder = "Enter Doctor Name">
                        </div>

                        <div class = "form-group"> 
                            <label> Specialty </label>
                            <input type = "text" name ="specialty" class = "form-control"
                            autocomplete = "off" placeholder = "Enter Specialty">
                        </div>

                        <input type = "submit" name = "login" class = "btn btn-success" value = "Insert">

                    </form>

                </div>
                <div class = "col-md-3"></div>

            </div>

        </div>

    </div>

</body>
</html> 
