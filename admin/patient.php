<?php
 session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootsrap@5.0.0-beta1/dist/css/bootsrap.min.css">
    <title>Patient Panel</title>
</head>
<body>
    <?php
    include "../include/header.php";
    

    ?>

    <div class= "container-fluid">
        <div class= "col-md-12 ">
            <div class= "row">
                <div class= "col-md-2 " style= "margin-left: -30px;">
                    <?php
                    
                        include "sidenav.php";
                        include "../include/config.php";
                    ?>
                </div>
                <div class= "col-md-10">
                      <div class= "col-md-12 ">
                        <div class= "row">
                            <div class= "col-md-6">

                            <?php 
                                if (isset($_POST['add'])) {
                                    $id = $_POST['id'];
                                    $patientname  = $_POST['patientname'];
                                    $symptom = $_POST['symptom'];
                                    $error = array();
                                    if (empty($id)) {
                                        $error['u'] = "Enter ID";
                                    }
                                    elseif (empty($patientname)) {
                                        $error['u'] = "Enter Patient Name";
                                    }
                                    elseif (empty($symptom)) {
                                        $error['u'] = "Enter Symptom";
                                    }
                                     if (count($error) == 0) {
                                        $q = "INSERT INTO patient(pid, pname, symptom) VALUES ('$id', '$patientname', '$symptom')";
                                        $result = mysqli_query($connect,$q);
                                     }

                                }

                                if (isset($error['u'])) {
                                    $er = $error['u'];
                                    $show =  "<h5 class= 'text-center alert alert-danger'>$er</h5>";
                                }
                                else{
                                    $show = "";
                                }



                            ?>



                                <h5 class= "text-center"> All Patients</h5>
                                <?php
                                    if(!isset($_POST['add'])){
                                        $output = "
                                        <table class= 'table table-bordered'> 
                                        <tr>
                                        <th>ID</th>
                                        <th>Patient Name</th>
                                        <th>Specialty</th>
                                        <th style= 'width: 10%;'>Action </th>
                                        </tr>
                                    
                                    ";
                                    $output .= "<tr><td colspan= '4'class= 'text-center'>No New Patient Found</td></tr> ";

                                    $output .= "
                                        
                                            </tr>
    
                                            </table>
                                        ";
                                        echo $output; 

                                    }
                                    if(isset($_POST['add'])){
                                           // $pat = $_SESSION['admin'];
                                        //$id = $_POST['id'];
                                        $query =  "SELECT * FROM patient WHERE pid = '$id'";
                                        $res = mysqli_query($connect, $query);
                                        $output = "
                                            <table class= 'table table-bordered'> 
                                            <tr>
                                            <th>ID</th>
                                            <th>Patient Name</th>
                                            <th>Symptom</th>
                                            <th style= 'width: 10%;'>Action </th>
                                            </tr>
                                        
                                        ";

                                    
                                        if (mysqli_num_rows($res)< 1) {
                                            $output .= "<tr><td colspan= '4'class= 'text-center'>No New Patient</td></tr> ";
                                        }
                                        while ($row =  mysqli_fetch_array($res)) {
                                            $id = $row['pid'];
                                            $pname = $row['pname'];
                                            $symptom = $row['symptom'];
                                            $output .= " 
                                                <tr>
                                                <td>$id</td>
                                                <td>$pname</td>
                                                <td>$symptom</td>
                                                <td>
                                                    <a href='patient.php?id=$id'><button pid= '$id' class= 'btn btn-danger remove'>Remove </button></a>
                                                </td>
    
                                            ";
                                        }


                                        $output .= "
                                        
                                            </tr>
                                            </table>
                                        ";
                                        echo $output; 


                                        
                                    }

                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $query = "DELETE FROM patient WHERE pid = '$id'";
                                        $res = mysqli_query($connect, $query);
                                    }
                                    
                                ?>
                               
                                    

                            </div>
                            <div class= "col-md-6">
                                <h5 class= "text-center">Add Patient </h5>
                                 <form action="" method= "post" enctype = 'multipart/form-data'>
                                    <div>
                                        <?php
                                        echo $show;

                                        ?>
                                    </div>
                                    <div class= "form-group"> 
                                        <label for="">ID</label>
                                        <input type="pass" name= "id" class= "form-control" autocomplete= "off">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Patient Name</label>
                                        <input type="text" name= "patientname" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                    <label for="">Symptom</label>
                                    <input type="text" name= "symptom" class= "form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name= "add" value = "Add New Patient" class= "btn btn-success">
                                 </form>

                            </div>
                        </div>
                      </div>
                </div>
            </div>

        </div>
    </div>


    <div class= "container" style = "position:absolute; left:550px; top:420px">
        <div class="row">
            <div class= "col-md-8">
                <div class= "card mt-4">
                    <div class= "card-header">
                        <h4>Filter Patient By Symptom</h4>

                    </div>
                    <div class= "card-body">
                        <div class= "row">
                            <div class= "col-md-7">
                                <form action="" method= "GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name= "search" value= "<?php  if(isset($_GET['search'])) {echo $_GET['search']; } ?>" class="form-control" placeholder="Search Patient" >
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type= "submit" class= "btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class= "card mt-4">
                    <div class= "card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Patient Name</td>
                                    <td>Patient ID</td>
                                    <td>Selected Symptom</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['search'])) {
                                        $filtervalues =  $_GET['search']; 
                                        $query = "SELECT * FROM patient WHERE symptom = '$filtervalues'";
                                        $query_run = mysqli_query($connect, $query);
                                        if (mysqli_num_rows($query_run)) {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                     <tr>
                                                         <td ><?=$items['pname']?></td>
                                                         <td ><?=$items['pid']?></td>
                                                         <td ><?=$items['symptom']?></td>
                                                     </tr>


                                                <?php
                                                 
                                            }
                                        }
                                        else{
                                            ?>
                                                <tr>
                                                      <td colspan= "4">No Patient Admitted With Given Symptom</td>
                                                </tr>

                                            <?php

                                        }
                                    }

                                ?> 
                                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                            
              
        </div>
        
    </div>
    <script src= "https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src= "https://cdn.jdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/boostrap.bundle.min.js"></script>

    
</body>
</html>
