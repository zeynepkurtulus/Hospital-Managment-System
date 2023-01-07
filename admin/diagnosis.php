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
    <title>Diagnosis Panel</title>
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
                                    $disease = $_POST['diseasename'];
                                    $type  = $_POST['diseasetype'];
                                    $error = array();
                                    if (empty($disease)) {
                                        $error['u'] = "Enter Disease Name";
                                    }
                                    elseif (empty($type)) {
                                        $error['u'] = "Enter Disease Type";
                                    }
                                     if (count($error) == 0) {
                                        $q = "INSERT INTO diagnosis(diseasename, disease_type) VALUES ('$disease', '$type')";
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



                                <h5 class= "text-center"> All Diagnosis</h5>
                                <?php
                                    if(!isset($_POST['add'])){
                                        //echo "No New Doctor Found";
                                        $output = "
                                        <table class= 'table table-bordered'> 
                                        <tr>
                                        <th>Disease Name</th>
                                        <th>Disease Type</th>
                                        <th style= 'width: 10%;'>Action </th>
                                        </tr>
                                    
                                    ";
                                    $output .= "<tr><td colspan= '4'class= 'text-center'>No New Diagnosis Found</td></tr> ";

                                    $output .= "
                                        
                                            </tr>
    
                                            </table>
                                        ";
                                        echo $output; 


                                    }
                                    if(isset($_POST['add'])){
                                            $query =  "SELECT * FROM diagnosis WHERE disease_type = '$type'";
                                        $res = mysqli_query($connect, $query);
                                        $output = "
                                            <table class= 'table table-bordered'> 
                                            <tr>
                                            <th>Disease Name</th>
                                            <th>Disease Type</th>
                                            <th style= 'width: 10%;'>Action </th>
                                            </tr>
                                        
                                        ";
                                    
                                        if (mysqli_num_rows($res)< 1) {
                                            $output .= "<tr><td colspan= '4'class= 'text-center'>No New Diagnosis Found</td></tr> ";
                                        }
                                        while ($row =  mysqli_fetch_array($res)) {
                                            $diseasename = $row['diseasename'];
                                            $type = $row['disease_type'];
                                            $output .= " 
                                                <tr>
                                                <td>$diseasename</td>
                                                <td>$type</td>
                                               
                                                <td>
                                                    <a href='diagnosis.php?diseasename=$diseasename'><button diseasename= '$diseasename' class= 'btn btn-danger remove'>Remove </button></a>
                                                </td>
    
                                            ";
                                        }


                                        $output .= "
                                        
                                            </tr>
                                            </table>
                                        ";
                                        echo $output; 


                    

                                    }
                                    
                                    if (isset($_GET['diseasename'])) {
                                        $diseasename = $_GET['diseasename'];
                                        $query = "DELETE FROM diagnosis WHERE diseasename = '$diseasename'";
                                        $res = mysqli_query($connect, $query);
                                    }
                                ?>
                               
                               
                                    

                            </div>
                            <div class= "col-md-6">
                                <h5 class= "text-center">Add Diagnosis </h5>
                                 <form action="" method= "post" enctype = 'multipart/form-data'>
                                    <div>
                                        <?php
                                        echo $show;

                                        ?>
                                    </div>
                                    <div class= "form-group"> 
                                        <label for="">Disease Name</label>
                                        <input type="pass" name= "diseasename" class= "form-control" autocomplete= "off">
                                    </div>
                                    <div class= "from-group">
                                        <label for="">Disease Type</label>
                                        <input type="text" name= "diseasetype" class= "form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name= "add" value = "Add New Diagnosis" class= "btn btn-success">
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
                        <h4>Filter Diagnosis By Name</h4>

                    </div>
                    <div class= "card-body">
                        <div class= "row">
                            <div class= "col-md-7">
                                <form action="" method= "GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name= "search" value= "<?php  if(isset($_GET['search'])) {echo $_GET['search']; } ?>" class="form-control" placeholder="Search Diagnosis" >
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
                                    <td>Disease Name</td>
                                    <td>Disease Type</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['search'])) {
                                        $filtervalues =  $_GET['search']; 
                                        $query = "SELECT * FROM diagnosis WHERE diseasename = '$filtervalues'";
                                        $query_run = mysqli_query($connect, $query);
                                        if (mysqli_num_rows($query_run)) {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                     <tr>
                                                         <td ><?=$items['diseasename']?></td>
                                                         <td ><?=$items['disease_type']?></td>
                                                     </tr>


                                                <?php
                                                 
                                            }
                                        }
                                        else{
                                            ?>
                                                <tr>
                                                      <td colspan= "4">No Disease With Given Type</td>
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
