<?php

session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php
     
    include "../include/header.php";
    include "../include/config.php";
    ?>

    <div class="container-fluid">
        <div class= "col-md-12">
            <div class= "row"> 
                <div class= "col-md-2" style= "margin-left: -30px; ">
                    <?php
                        include "sidenav.php";
                    ?>
                </div>
                <div class= "col-md-10">

                    <h4 class= "my-2">Dashboard</h4>
                     <div class= "col-md-12 my-5">
                        <div class= "row">
                        <div class= "col-md-3 bg-info mx-2" style= "height: 130px;">

                            <div class= "col-md-12">
                                <div class= "row">
                                    <div class= "col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM admin");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                        <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                        <h5 class= "text-white">Total</h5>
                                        <h5 class= "text-white" >Admin </h5>
                                    </div>
                                    <div class= "col-md-4">
                                        <a href= "admin.php"><i class= "fa fa-users-cog fa-3x my-4" style= "color: white;"></i></a>

                                    </div>
                                </div>
                            </div>

                        </div>

                            <div class= "col-md-3 bg-info mx-2" style= "height: 130px;">
                                <div class= "col-md-12">
                                    <div class= "row">
                                        <div class= "col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM doctor");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                            <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                            <h5 class= "text-white">Total</h5>
                                            <h5 class= "text-white" >Doctors </h5>
                                        </div>
                                        <div class= "col-md-4">
                                            <a href= "doctor.php"><i class= "fa fa-user-md fa-3x my-4" style= "color: white;"></i></a>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class= "col-md-3 bg-info mx-2" style= "height: 130px;">
                                    
                                <div class= "col-md-12">
                                        <div class= "row">
                                            <div class= "col-md-8">
                                            <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM patient");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                                <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                                <h5 class= "text-white">Total</h5>
                                                <h5 class= "text-white" >Patients </h5>
                                            </div>
                                            <div class= "col-md-4">
                                                <a href= "patient.php"><i class= "fa fa-procedures fa-3x my-4" style= "color: white;"></i></a>

                                            </div>
                                        </div>
                                </div>

                            </div>

                            <div class= "col-md-3 bg-info  mx-2 my-2" style= "height: 130px;">

                                <div class= "col-md-12">
                                        <div class= "row">
                                             <div class= "col-md-8">
                                             <?php
                                                $ad = mysqli_query($connect, "SELECT * FROM diagnosis");
                                                $num = mysqli_num_rows($ad);


                                            ?>
                                                    <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                                    <h5 class= "text-white">Diagnosis</h5>
                                             </div>
                                            <div class= "col-md-4">
                                                    <a href= "diagnosis.php"><i class= "fa fa-solid fa-stethoscope fa-3x my-4" style= "color: white;"></i></a>

                                            </div>
                                        </div>
                                </div>

                            </div>

                            <div class= "col-md-3 bg-info mx-2 my-2" style= "height: 130px;">

                                <div class= "col-md-12">
                                    <div class= "row">
                                        <div class= "col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM nurse");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                                    <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                                    <h5 class= "text-white">Nurses</h5>
                                        </div>
                                         <div class= "col-md-4">
                                                    <a href= "nurse.php"><i class= "fa fa-solid fa-user-nurse fa-3x my-4" style= "color: white;"></i></a>

                                         </div>
                                    </div>
                                </div>

                            </div>

                            <div class= "col-md-3 bg-info mx-2 my-2" style= "height: 130px;">

                                <div class= "col-md-12">
                                    <div class= "row">
                                        <div class= "col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM treats");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                                    <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                                    <h5 class= "text-white">Treatments</h5>
                                        </div>
                                        <div class= "col-md-4">
                                                    <a href= "treats.php"><i class= "fa fa-solid fa-truck-medical fa-3x my-4" style= "color: white;"></i></a>

                                        </div>
                                     </div>
                                </div>

                            </div>

                            <div class= "col-md-3 bg-info mx-2 my-2" style= "height: 130px;">
                                <div class= "col-md-12">
                                    <div class= "row">
                                        <div class="col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM has_diagnosis");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                            <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                             <h5 class= "text-white">Patient Disease Info</h5>

                                        </div>
                                        <div class= "col-md-4">
                                        <a href= "has_diagnosis.php"><i class= "fa fa-duonote fa-circle-info fa-3x my-4" style= "color: white;"></i></a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                    

                            <div class= "col-md-3 bg-info mx-2 my-2" style= "height: 130px;">
                                <div class= "col-md-12">
                                    <div class= "row">
                                        <div class="col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM nursing");
                                            $num = mysqli_num_rows($ad);


                                        ?>
                                            <h5 class= "my-2 text-white" style= "font-size: 30px;"><?php echo $num;?></h5>
                                             <h5 class= "text-white">Assigned Nurses</h5>

                                        </div>
                                        <div class= "col-md-4">
                                        <a href= "nursing.php"><i class= "fa fa-solid fa-arrows-rotate fa-3x my-4" style= "color: white;"></i></a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class= "col-md-3 bg-info mx-2 my-2" style= "height: 130px;">
                                <div class= "col-md-14">
                                    <div class= "row">
                                        <div class="col-md-8">
                                            <h5 class= "my-2 text-white" style= "font-size: 20px;">Chat Support</h5>

                                        </div>
                                        <div class= "col-md-4">
                                        <a href= "chatpage.php"><i class= "fa fa-comment fa-3x my-4" style= "color: white;"></i></a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>