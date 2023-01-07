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
    <title>Treatment Panel</title>
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
                                    $did = $_POST['did'];
                                    $dname = $_POST['dname'];
                                    $pname = $_POST['pname'];
                                    $id = $_POST['id'];
                                    $specialty  = $_POST['spec'];
                                    $symptom = $_POST['symptom'];
                                    $error = array();
                                    if (empty($id)) {
                                        $error['u'] = "Enter Patient ID";
                                    }
                                    if (empty($did)) {
                                        $error['u'] = "Enter Doctor ID";
                                    }
                                    if (empty($dname)) {
                                        $error['u'] = "Enter Doctor Name";
                                    }
                                    if (empty($pname)) {
                                        $error['u'] = "Enter Patient Name";
                                    }
                                    if (empty($specialty)) {
                                        $error['u'] = "Enter Specialty";
                                    }
                                    elseif (empty($symptom)) {
                                        $error['u'] = "Enter Symptom";
                                    }
                                     if (count($error) == 0) {
                                        $query = "INSERT INTO treats(did, dname, specialty, pid, pname, symptom) VALUES ('$did', '$dname', '$specialty', '$id', '$pname', '$symptom')";
                                        $result = mysqli_query($connect,$query);
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



                                <h5 class= "text-center"> All Treatment Plans</h5>
                          
                                <?php
                                    if(!isset($_POST['add'])){
                                        
                                        $output = "
                                        <table class= 'table table-bordered'> 
                                        <tr>
                                        <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                        <th>Doctor Specialty</th>
                                        <th>Symptom</th>
                                        
                                        <th style= 'width: 10%;'>Action </th>
                                        </tr>
                                    
                                    ";
                                    $output .= "<tr><td colspan= '5'class= 'text-center'>No New Treatment Plan Found</td></tr> ";

                                    $output .= "
                                        
                                            </tr>
    
                                            </table>
                                        ";
                                        echo $output; 

                                    }
                                    if(isset($_POST['add'])){
                                            //$treat = $_SESSION['admin'];
                                        //$id = $_POST['id'];
                                        $query =  "SELECT * FROM treats WHERE pid = '$id'";
                                        $res = mysqli_query($connect, $query);
                                    
                                        $output = "
                                            <table class= 'table table-bordered'> 
                                            <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Doctor Specialty</th>
                                            <th>Symptom</th>
                                            <th style= 'width: 10%;'>Action </th>
                                            </tr>
                                        
                                        ";
                                    
                                        if (mysqli_num_rows($res)< 1) {
                                            $output .= "<tr><td colspan= '5'class= 'text-center'>No New Treatment Plan</td></tr> ";
                                        }
                                        while ($row =  mysqli_fetch_array($res)) {
                                            $pname = $row['pname'];
                                            $id = $row['pid'];
                                            $dname = $row['dname'];
                                            $did = $row['did'];
                                            $spec = $row['specialty'];
                                            $symptom = $row['symptom'];
                                            $output .= " 
                                                <tr>
                                                <td>$pname</td>
                                                <td>$dname</td>
                                                <td>$spec</td>
                                                <td>$symptom</td>
                                                <td>
                                                    <a href='treats.php?id=$id'><button pid= '$id' class= 'btn btn-danger remove'>Remove </button></a>
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
                                        $query = "DELETE FROM treats WHERE pid = '$id'";
                                        $res = mysqli_query($connect, $query);
                                    }
                                   
                                ?>
                               
                                    

                            </div>
                            <div class= "col-md-6">
                                <h5 class= "text-center">Add Treatment </h5>
                                 <form action="" method= "post" enctype = 'multipart/form-data'>
                                    <div>
                                        <?php
                                        echo $show;

                                        ?>
                                    </div>
                                    <div class= "form-group"> 
                                        <label for="">Patient Name</label>
                                        <input type="text" name= "pname" class= "form-control" autocomplete= "off">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Patient ID</label>
                                        <input type="text" name= "id" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Doctor Name</label>
                                        <input type="text" name= "dname" class= "form-control">
                                        </div>
                                    <div class= "from-group">
                                        <label for="">Doctor ID</label>
                                        <input type="text" name= "did" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Specialty</label>
                                        <input type="text" name= "spec" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Symptom</label>
                                        <input type="text" name= "symptom" class= "form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name= "add" value = "Add New Treatment Plans" class= "btn btn-success">
                                 </form>

                            </div>
                        </div>
                      </div>
                </div>
            </div>

        </div>
    </div>


    <div class= "container" style = "position:absolute; left:550px; top:650px">
        <div class="row">
            <div class= "col-md-8">
                <div class= "card mt-4">
                    <div class= "card-header">
                        <h4>Filter Treatments By Assigned Doctor</h4>

                    </div>
                    <div class= "card-body">
                        <div class= "row">
                            <div class= "col-md-7">
                                <form action="" method= "GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name= "search" value= "<?php  if(isset($_GET['search'])) {echo $_GET['search']; } ?>" class="form-control" placeholder="Search Treatment" >
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
                                    <td>Selected Doctor Name</td>
                                    <td>Doctor Specialty</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['search'])) {
                                        $filtervalues =  $_GET['search']; 
                                        $query = "SELECT * FROM treats WHERE did = '$filtervalues'";
                                        $query_run = mysqli_query($connect, $query);
                                        if (mysqli_num_rows($query_run)) {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                     <tr>
                                                         <td ><?=$items['pname']?></td>
                                                         <td ><?=$items['dname']?></td>
                                                         <td ><?=$items['specialty']?></td>
                                                     </tr>


                                                <?php
                                                 
                                            }
                                        }
                                        else{
                                            ?>
                                                <tr>
                                                      <td colspan= "4">No Treatment Plan Found with the Given Doctor</td>
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
