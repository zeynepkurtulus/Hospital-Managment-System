<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link rel="stylesheet" type= "text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.2.slim.js" integrity="sha256-OflJKW8Z8amEUuCaflBZJ4GOg4+JnNh9JdVfoV+6biw=" crossorigin="anonymous"></script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" type= "text/css"  href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <nav class= "navbar navbar-expand-lg navbar-info bg-info">
        <h5 class= "text-white">Hospital Managment System</h5>
        <div class= "mr-auto"></div>
        <ul class="navbar-nav">
            <?php

                if (isset($_SESSION['admin'])) {
                    $user = $_SESSION['admin'];
                    echo '
                    <li class= "nav-item"> <a href="#" class= "nav-link text-white" >'.$user.'</a></li>
                    <li class= "nav-item"> <a href="logout.php" class= "nav-link text-white">logout</a></li>
                   
                
                
                    ';

                }
                


                

                else{
                    echo'
                    <li  class= "nav-item"> <a href="adminlogin.php " class= "nav-link text-white" >Admin</a></li>
                <li class= "nav-item"> <a href="doctor.php" class= "nav-link text-white" >Doctor</a></li>
                <li class= "nav-item"> <a href="#" class= "nav-link text-white" >Patient</a></li>




                    ';
                }



            ?>
        </ul>

    </nav>
</body>
</html>