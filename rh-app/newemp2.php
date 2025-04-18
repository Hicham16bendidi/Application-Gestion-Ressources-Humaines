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
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $stm= $PDO->prepare("SELECT * FROM users WHERE ID=?");
        $res=$stm->execute([$id]);
        $res=$stm->fetch();
        $stm= $PDO->prepare("SELECT * FROM employe WHERE ID=?");
        $resl=$stm->execute([$id]);
        $resl=$stm->fetch();
        
       if(isset($_POST['Register'])){

            $Name = $_POST['Name'];
            $Username = $_POST['Username'];
            $type = "admin";
            $Password = $_POST['Password'];
            $Password1 = $_POST['Password1'];
            if($Password!=$Password1){
              echo "The two passwords are not matching!";
            }else{
              $newuser = new user('',$Name, $Username,  $Password);
   
              $stm = $PDO->prepare("UPDATE users SET Name=? AND Username=? AND  Password=? WHERE ID =?");
              $result = $stm->execute([$newuser->getName(),$newuser->getuserName(),$newuser->getPassword(),$id]);
              
              
    
              if($result){
              $stm = $PDO->prepare("INSERT INTO employe (ID,Prenom, Email, Telephone,Departement,Poste,Salaire) VALUES (?,?,?,?,?,?,?)");
              $resu = $stm->execute([$id,$_POST["prenom"],$_POST["email"],$_POST["telephone"],$_POST["departement"],$_POST["poste"],$_POST["salaire"]]);
              var_dump($resu);
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
      <div class="col-lg-12 col-xl-11" >
        <div class="card text-black" style="box-shadow:3px 3px blue, -1em 0 .4em purple;border-radius: 25px; background: linear-gradient(to right, rgba(100, 10, 100, 100), rgba(37, 117, 252, 1)">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">New Employe</p>

                <form class="mx-1 mx-md-4" action="newemp2.php" enctype="multypart/form-data" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="text" id="form3Example1c" class="form-control" name="Name" placeholder="Name" value="<?php echo $res["Name"];?>" required/>
                                <label class="form-label" for="form3Example1c"></label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="username" id="form3Example3c" class="form-control" name="Username" placeholder="User Name" value="<?php echo $res["Username"];?>" required/>
                                <label class="form-label" for="form3Example3c"></label>
                                </div>
                            </div>
                            
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="password" id="form3Example4c" class="form-control" name="Password" placeholder="Password" value="<?php echo $res["Password"];?>" required/>
                                <label class="form-label" for="form3Example4c"></label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="password" id="form3Example4cd" class="form-control" name="Password1" placeholder="Confirm Password" value="<?php echo $res["Password"];?>" required/>
                                <label class="form-label" for="form3Example4cd"></label>
                                </div>
                            </div>
                        </div>       
                        <div class="col-md-6">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="text" id="form3Example1c" class="form-control" name="prenom" placeholder="Prenom" value="<?php if ($resl) echo $resl["Prenom"];?>" required/>
                                <label class="form-label" for="form3Example1c"></label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="email" id="form3Example3c" class="form-control" name="email" placeholder="E-mail" value="<?php if ($resl)echo $resl["Email"];?>" required/>
                                <label class="form-label" for="form3Example3c"></label>
                                </div>
                            </div>
                            
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="number" id="form3Example4c" class="form-control" name="telephone" placeholder="Telephone" value="<?php if ($resl) echo $resl["Telephone"];?>" required/>
                                <label class="form-label" for="form3Example4c"></label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="text" id="form3Example4cd" class="form-control" name="departement" placeholder="Departement" value="<?php if ($resl) echo $resl["Departement"];?>" required/>
                                <label class="form-label" for="form3Example4cd"></label>
                                </div>
                            </div> 
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="text" id="form3Example4c" class="form-control" name="poste" placeholder="Poste" value="<?php if($resl) echo $resl["Poste"];?>" required/>
                                <label class="form-label" for="form3Example4c"></label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                <input type="number" id="form3Example4cd" class="form-control" name="salaire" placeholder="Salaire" value="<?php echo $resl["Salaire"];?>" required/>
                                <label class="form-label" for="form3Example4cd"></label>
                                </div>
                            </div>
                        </div>
                    </div>     
                  <p class="text-center text-muted mt-5 mb-0">Abandon? <a href="admnpage.php" class="fw-bold text-body">Cancel</a></p>
                  <br></br>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-outline-dark btn-lg px-5" name="Register">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://orbscope.com/wp-content/uploads/2020/05/Picture5.png" class="img-fluid" alt="Sample image">

              </div>
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
      
    </body>
  </html>
    