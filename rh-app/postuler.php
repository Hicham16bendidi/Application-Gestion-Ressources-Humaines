<?php  
   include_once 'conn.php';
   include_once 'candidat.php';
   
       $PDO = DB_conn();
       session_start();
       

        
       if(isset($_POST['Register'])){

           
           
              
   
              $stm = $PDO->prepare("INSERT INTO candidat (nom, prenom,  email,telephone,adresse,dateNaissance,experience,formation,idOffre)
               VALUES (?,?,?,?,?,?,?,?,?)");
              $result = $stm->execute([$_POST["nom"],$_POST["prenom"],$_POST["email"],$_POST["telephone"],
              $_POST["addresse"],$_POST["datenaissance"],$_POST["experience"],$_POST["formation"],$_POST["id"]]);
              var_dump($result);
    
              if($result){
                header("Location: /rh-app/home.php");

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
                            <div class="row justify-content-center">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Remplir le Formulaire</p>
                                
                                <form class="mx-1 mx-md-4" action="postuler.php" enctype="multipart/form-data" method="POST">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="form3Example1c">id d'offre:</label>
                                                    <input type="text" id="form3Example1c" class="form-control" name="id" 
                                                    value="<?php echo $_GET['id']; ?>" readonly/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c"> Nom :</label>
                                                    <input type="text" id="form3Example1c" class="form-control" name="nom" placeholder="Nom" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Prénom :</label>
                                                    <input type="username" id="form3Example3c" class="form-control" name="prenom" placeholder="Prenom" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Adresse</label>
                                                    <input type="text" id="form3Example1c" class="form-control" name="addresse" placeholder="Adresse" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Experience (YES/NO) :</label>
                                                    <input type="Text" id="form3Example4c" class="form-control" name="experience" placeholder="Experience" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Formation (field) :</label>
                                                    <input type="Text" id="form3Example4cd" class="form-control" name="formation" placeholder="Formation" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Date de Naissance :</label>
                                                    <input type="Date" id="form3Example3c" class="form-control" name="datenaissance" placeholder="Date de naissance" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Email :</label>
                                                    <input type="mail" id="form3Example4c" class="form-control" name="email" placeholder="e-mail" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Telephone :</label>
                                                    <input type="Number" id="form3Example4cd" class="form-control" name="telephone" placeholder="Telephone" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-center text-white mt-5 mb-0">Abandon? <a href="home.php" class="fw-bold text-body"><u>Cancel</u></a></p>
                                    <br></br>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-outline-dark btn-lg px-5" name="Register">Register</button>
                                    </div>
                                </form>
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
    