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
    <title>Admin Panel</title>
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
                                    $nid = $_POST['nid'];
                                    $nname = $_POST['nname'];
                                    $pname = $_POST['pname'];
                                    $pid = $_POST['pid'];
                                    $ndepartment  = $_POST['ndepartment'];
                                    $symptom = $_POST['symptom'];
                                    $error = array();
                                    if (empty($pid)) {
                                        $error['u'] = "Enter Patient ID";
                                    }
                                    if (empty($nid)) {
                                        $error['u'] = "Enter Nurse ID";
                                    }
                                    if (empty($pname)) {
                                        $error['u'] = "Enter Patient Name";
                                    }
                                    if (empty($nname)) {
                                        $error['u'] = "Enter Nurse Name";
                                    }
                                    if (empty($ndepartment)) {
                                        $error['u'] = "Enter Department";
                                    }
                                    elseif (empty($symptom)) {
                                        $error['u'] = "Enter Symptom";
                                    }
                                     if (count($error) == 0) {
                                        $query = "INSERT INTO nursing(pid, pname, symptom, nid, nname, ndepartment) VALUES ('$pid', '$pname', '$symptom', '$nid', '$nname', '$ndepartment')";
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



                                <h5 class= "text-center"> All Nursing Plans</h5>
                          
                                <?php
                                    if(!isset($_POST['add'])){
                                        
                                        $output = "
                                        <table class= 'table table-bordered'> 
                                        <tr>
                                        <th>Patient Name</th>
                                        <th>Nurse Name</th>
                                        <th>Nurse ID</th>
                                        <th>Nurse Department</th>
                                        
                                        <th style= 'width: 10%;'>Action </th>
                                        </tr>
                                    
                                    ";
                                    $output .= "<tr><td colspan= '5'class= 'text-center'>No New Nursing Plan Found</td></tr> ";

                                    $output .= "
                                        
                                            </tr>
    
                                            </table>
                                        ";
                                        echo $output; 

                                    }
                                    if(isset($_POST['add'])){
                                            //$treat = $_SESSION['admin'];
                                        //$id = $_POST['id'];
                                        $query =  "SELECT * FROM nursing WHERE nid = '$nid'";
                                        $res = mysqli_query($connect, $query);
                                    
                                        $output = "
                                            <table class= 'table table-bordered'> 
                                            <tr>
                                            <th>Patient Name</th>
                                            <th>Nurse Name</th>
                                            <th>Nurse ID</th>
                                            <th>Nurse Department</th>
                                            <th style= 'width: 10%;'>Action </th>
                                            </tr>
                                        
                                        ";
                                    
                                        if (mysqli_num_rows($res)< 1) {
                                            $output .= "<tr><td colspan= '5'class= 'text-center'>No New Treatment Plan</td></tr> ";
                                        }
                                        while ($row =  mysqli_fetch_array($res)) {
                                            $pname = $row['pname'];
                                            //$id = $row['pid'];
                                            $nname = $row['nname'];
                                            $nid = $row['nid'];
                                            $ndepartment = $row['ndepartment'];
                                            //$symptom = $row['symptom'];
                                            $output .= " 
                                                <tr>
                                                <td>$pname</td>
                                                <td>$nname</td>
                                                <td>$nid</td>
                                                <td>$ndepartment</td>
                                                <td>
                                                    <a href='treats.php?nid=$nid'><button nid= '$nid' class= 'btn btn-danger remove'>Remove </button></a>
                                                </td>
    
                                            ";
                                        }


                                        $output .= "
                                        
                                            </tr>
                                            </table>
                                        ";
                                        echo $output; 


                                        
                                    }

                                    if (isset($_GET['nid'])) {
                                        $nid = $_GET['nid'];
                                        $query = "DELETE FROM nursing WHERE nid = '$nid'";
                                        $res = mysqli_query($connect, $query);
                                    }
                                 
                                   
                                ?>
                               
                                    

                            </div>
                            <div class= "col-md-6">
                                <h5 class= "text-center">Assign Nursing Info</h5>
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
                                        <input type="text" name= "pid" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Nurse Name</label>
                                        <input type="text" name= "nname" class= "form-control">
                                        </div>
                                    <div class= "from-group">
                                        <label for="">Nurse ID</label>
                                        <input type="text" name= "nid" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Nurse Department</label>
                                        <input type="text" name= "ndepartment" class= "form-control">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Symptom</label>
                                        <input type="text" name= "symptom" class= "form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name= "add" value = "Add New Nursing Info" class= "btn btn-success">
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
                        <h4>Filter Nursing Info By ID</h4>

                    </div>
                    <div class= "card-body">
                        <div class= "row">
                            <div class= "col-md-7">
                                <form action="" method= "GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name= "search" value= "<?php  if(isset($_GET['search'])) {echo $_GET['search']; } ?>" class="form-control" placeholder="Search Nursing Info" >
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
                                    <td>Selected Nurse</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['search'])) {
                                        $filtervalues =  $_GET['search']; 
                                        $query = "SELECT * FROM nursing WHERE nid = '$filtervalues'";
                                        $query_run = mysqli_query($connect, $query);
                                        if (mysqli_num_rows($query_run)) {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                     <tr>
                                                         <td ><?=$items['pname']?></td>
                                                         <td ><?=$items['pid']?></td>
                                                         <td ><?=$items['nname']?></td>
                                                     </tr>


                                                <?php
                                                 
                                            }
                                        }
                                        else{
                                            ?>
                                                <tr>
                                                      <td colspan= "4">No Nursing Info Regarding Selected Patient Found</td>
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
