<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootsrap@5.0.0-beta1/dist/css/bootsrap.min.css">
    <title>All Doctors</title>
</head>
<body>
<?php
    include "../include/header.php";
    

    ?>

    <div class= "container-fluid">
        <div class= "col-md-12 " >
            <div class= "row" >
                <div class= "col-md-2 " style= "margin-left: -30px;" >
                    <?php
                    
                        include "sidenav.php";
                        include "../include/config.php";
                    ?>
                </div>
                <div class= "col-md-10" >
                      <div class= "col-md-12 ">
                        <div class= "row">
                            <div class= "col-md-6">

                                &nbsp;
                                <h5 class= "text-center"> All Doctors</h5>
                                <?php
                                   
                                        $query =  "SELECT * FROM has_diagnosis";
                                        $res = mysqli_query($connect, $query);
                                        //$resultcheck = mysqli_num_rows($res);
                                        $output = "
                                            <table class= 'table table-bordered'> 
                                            <tr>
                                            <th>Patient Name</th>
                                            <th>Patient ID</th>
                                            <th>Symptom</th>
                                            <th>Disease Name </th>
                                            <th>Disease Type</th>
                                            </tr>
                                        
                                        ";
                                    
                                        if (mysqli_num_rows($res) < 1) {
                                            $output .= "<tr><td colspan= '4'class= 'text-center'>No New Diagnosis</td></tr> ";
                                        }
                                        while ($row =  mysqli_fetch_array($res)) {
                                            $disname = $row['diseasename'];
                                            $distype = $row['diseasetype'];

                                            $pname = $row['pname'];
                                            $pid = $row['pid'];
                                            $symptom = $row['symptom'];
                                            $output .= " 
                                                <tr>

                                                <td>$pname</td>
                                                <td>$pid</td>
                                                <td>$symptom</td>
                                                <td>$disname</td>
                                                <td>$distype</td>
                                                <td>
                                                    <a href='diagnosisdisplay.php?pid=$pid'><button pid= '$pid' class= 'btn btn-danger remove'>Remove </button></a>
                                                </td>
    
                                            ";
                                        }

                                        


                                        $output .= "
                                        
                                            </tr>
                                            </table>
                                        ";
                                        echo $output; 
                                        if (isset($_GET['pid'])) {
                                            $pid = $_GET['pid'];
                                            $query = "DELETE FROM has_diagnosis WHERE pid = '$pid'";
                                            $res = mysqli_query($connect, $query);
                                        }


                                    
                                ?>
                               
                                    
                        </div>
                      </div>
                </div>
            </div>

        </div>
    </div>


    <script src= "https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src= "https://cdn.jdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/boostrap.bundle.min.js"></script>
    
</body>
</html>