<?php

include_once 'conn.php';
include_once 'user.php';

    $PDO = DB_conn();
    session_start();



    if(isset($_POST["Login"])){
        
        $query=$PDO->prepare('SELECT * FROM users WHERE Username=? AND Password=?');
        $query->execute(array($_POST["User"],$_POST["Pass"]));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount()==1){
            if($result['user_type']==NULL){
                $user = new user($result['ID'], $result['Name'], $result['Username'],$result['User_type'], $result['Password']);
                $_SESSION["userData"] = $user;
                header("Location:userpage.php");
            } elseif ($result['user_type']=='respo') {
                $admin = new user($result['ID'], $result['Name'], $result['Username'], $result['user_type'], $result['Password']);
                $_SESSION["userData"] = $admin;
                header("Location:respopage.php");
            }else {
                $admin = new user($result['ID'], $result['Name'], $result['Username'], $result['user_type'], $result['Password']);
                $_SESSION["userData"] = $admin;
                header("Location:admnpage.php");
            }
        }
        else {
            echo 'info invalide !';
        }
      }
    

?>
<!doctype html>
<html lang="en">
    <head>
    <title>AGRH Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">
                        <form style="width: 23rem;" action="login.php" enctype="multypart/form-data" method="POST">
                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your user name and password!</p>

                            <div class="form-outline form-white mb-4">
                                <input type="username" id="typeEmailX" class="form-control form-control-lg" name="User" placeholder = "Username" required/>
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input type="password" id="typePasswordX" class="form-control form-control-lg" name="Pass" placeholder = "Password" required/>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name = "Login">Login</button>
                            <div>
                            <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a></p>
                            </div>
                        
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
</section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href = "style.css" rel = "stylesheet">
    </body>
</html>

