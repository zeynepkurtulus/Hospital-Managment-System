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
                                   
                                        $query =  "SELECT * FROM doctor";
                                        $res = mysqli_query($connect, $query);
                                        //$resultcheck = mysqli_num_rows($res);
                                        $output = "
                                            <table class= 'table table-bordered'> 
                                            <tr>
                                            <th>ID</th>
                                            <th>Doctor Name</th>
                                            <th>Specialty</th>
                                            </tr>
                                        
                                        ";
                                    
                                        if (mysqli_num_rows($res) < 1) {
                                            $output .= "<tr><td colspan= '4'class= 'text-center'>No New Doctor</td></tr> ";
                                        }
                                        while ($row =  mysqli_fetch_array($res)) {
                                            $did = $row['did'];
                                            $doctorname = $row['dname'];
                                            $specialty = $row['specialty'];
                                            $output .= " 
                                                <tr>
                                                <td>$did</td>
                                                <td>$doctorname</td>
                                                <td>$specialty</td>
                                                <td>
                                                 <a href='doctordisplay.php?did=$did'><button did= '$did' class= 'btn btn-danger remove'>Remove </button></a>
                                                </td>
    
                                            ";
                                        }

                                        


                                        $output .= "
                                        
                                            </tr>
                                            </table>
                                        ";
                                        echo $output; 
                                        if (isset($_GET['did'])) {
                                            $did = $_GET['did'];
                                            $query = "DELETE FROM doctor WHERE did = '$did'";
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