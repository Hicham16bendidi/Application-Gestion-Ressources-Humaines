<?php  
   include_once 'conn.php';
   include_once 'user.php';
   
       $PDO = DB_conn();
       session_start();

        if(isset($_SESSION["userData"])){

        $user = $_SESSION["userData"];
        if($user->getusertype()==NULL){
            header("Location: /rh-app/userpage.php");
            echo "You're not an admin!";
        }
        }else{
            echo "Please log in as admin!";
            header("Location: /rh-app/login.php");
            exit;
        }
        
       if(isset($_POST['Register'])){

            $Name = $_POST['Name'];
            $Username = $_POST['Username'];
            $type = "admin";
            $Password = $_POST['Password'];
            $Password1 = $_POST['Password1'];
            $prenom= $_POST['prenom'];
            $telephone = $_POST['telephone'];
            $email =$_POST['email'];
            if($Password!=$Password1){
              echo "The two passwords are not matching!";
            }else{
              $newuser = new user('',$Name, $Username,NULL,  $Password);
   
              $stm = $PDO->prepare("INSERT INTO users (Name, Username,  Password,Prenom,Telephone,Email) VALUES (?,?,?,?,?,?)");
              $result = $stm->execute([$newuser->getName(),$newuser->getuserName(),$newuser->getPassword(),$prenom,$telephone,$email]);
              var_dump($result);
    
              if($result){
                if($user->getusertype()=='respo'){
                  header("Location: /rh-app/respopage.php");
                  echo "New admin created: ".$result['Username'];
                  exit;
              }else if($user->getusertype()=='admin'){
                  header("Location: /rh-app/admnpage.php");
                  echo "New admin created: ".$result['Username'];
                  exit;
              }else{
                  echo "Invalid user info.";
              }
            }

            }  
        }
      
        
?>  

<!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin Sign Up</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <section class="vh-100" style="background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1)">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="box-shadow:3px 3px blue, -1em 0 .4em purple;border-radius: 25px; background: linear-gradient(to right, rgba(100, 10, 100, 100), rgba(37, 117, 252, 1)">
          <div class="card-body p-md-5">
          <form class="mx-1 mx-md-4" action="newemp.php" method="POST">
            <div class="row justify-content-center">

              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="form3Example1c" class="form-control" name="Name" placeholder="Nom" required/>
                    <label class="form-label" for="form3Example1c"></label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="form3Example1c" class="form-control" name="prenom" placeholder="Prenom" required/>
                    <label class="form-label" for="form3Example1c"></label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="username" id="form3Example3c" class="form-control" name="Username" placeholder="Nom d'utilisateur" required/>
                    <label class="form-label" for="form3Example3c"></label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="number" id="form3Example4c" class="form-control" name="telephone" placeholder="Telephone" required/>
                    <label class="form-label" for="form3Example4c"></label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="email" id="form3Example4cd" class="form-control" name="email" placeholder="E-mail" required/>
                    <label class="form-label" for="form3Example4cd"></label>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="password" id="form3Example4c" class="form-control" name="Password" placeholder="Password" required/>
                    <label class="form-label" for="form3Example4c"></label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="password" id="form3Example4cd" class="form-control" name="Password1" placeholder="Confirm Password" required/>
                    <label class="form-label" for="form3Example4cd"></label>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6 mb-4">
              <p class="text-white text-center  mt-5 mb-0">Abandon? <a href="admnpage.php" class="fw-bold text-body">Cancel</a></p>
              </div> 
                  <br></br>
              <div class="col-12">
                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button type="submit" class="btn btn-outline-dark btn-lg px-5" name="Register">Register</button>
                </div>
              </div>

            </div>
      </form>
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
      
    </body>
  </html>
    