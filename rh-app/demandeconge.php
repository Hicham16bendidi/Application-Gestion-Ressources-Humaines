<?php  
   include_once 'conn.php';
   include_once 'user.php';
   //include_once 'user.php';
   
       $PDO = DB_conn();
       session_start();

        if(isset($_SESSION["userData"])){
            $user=$_SESSION["userData"];
            
        }  

       if(isset($_POST['add'])){
        $atm = $PDO->prepare("SELECT * FROM conge  WHERE idEmploye=? ");
            
         $atm->execute([$user->getID()]);
        $res = $atm->fetch();
        if($res){
          
          
           $alert_message = "Déja demandé!";

          
          echo "<script>alert('" . $alert_message . "');</script>";
            
        }else{
            $stm = $PDO->prepare("INSERT INTO conge (idEmploye,dateDebut,dateFin,motif) VALUES (?,?,?,?) ");
            
            $result = $stm->execute([$user->getID(),$_POST["datedebut"],$_POST["datefin"],$_POST["motif"]]);
            $result = $stm->fetch();
            //var_dump($result);
            header("Location: /rh-app/userpage.php");
            exit;
        }
      }

?>  

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Demander Congé</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">AGRH</a>
  </div>
</nav>
<section class="vh-100" style="background: #1589FF">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11" >
        <div class="card text-black" style="box-shadow:3px 3px blue, -1em 0 .4em blue;border-radius: 25px; background: #2B60DE">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Demande de Congé</p>

                <form class="mx-1 mx-md-4" action="demandeconge.php" enctype="multypart/form-data" method="POST">

                  
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Date de debut :</label>
                      <input type="date" id="form3Example1c" class="form-control" name="datedebut" placeholder="Date de debut" required/>
                      
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Date de Fin :</label>
                      <input type="date" id="form3Example1c" class="form-control" name="datefin" placeholder="Date de Fin" required/>
                      
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="motif" placeholder="Motif" required />
                      <label class="form-label" for="form3Example1c"></label>
                    </div>
                  </div>

                  
                  <p class="text-center text-white mt-5 mb-0">Give up adding? <a href="userpage.php" class="fw-bold text-body"><u>Cancel</u></a></p>
                  <br></br>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-outline-dark btn-lg px-5" name="add">Envoyer</button>
                  </div>
                </form>
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="rhpic.jpg" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>