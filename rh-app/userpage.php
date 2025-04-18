<?php
include_once 'user.php';
include_once 'conn.php';

$PDO = DB_conn();

session_start();
    
    if(isset($_SESSION["userData"])){
        $user = $_SESSION["userData"];
    }else{
        header("Location: /rh-app/login.php");
        exit;
    }

    $stm = $PDO->prepare("SELECT * FROM users WHERE ID=?");
    $stm->execute([$user->getID()]);
    $result = $stm->fetch();
    $atm = $PDO->prepare("SELECT * FROM conge WHERE idEmploye=?");
    $atm->execute([$user->getID()]);
    $res = $atm->fetchAll();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">AGRH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="formation.php"><button type="button" class="btn btn-primary" type="submit">Formation</button></a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="goals.php"><button type="button" class="btn btn-primary" type="submit">Taches et Objectives</button></a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="demandeconge.php"><button type="button" class="btn btn-primary" type="submit">Congé</button></a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="userpage.php"><button type="button" class="btn btn-primary" type="submit">Moi</button></a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href='logout.php'><button type="button" class="btn btn-primary" type="submit">Logout</button></a>
            </li>
            
        </ul>
        </div>
    </div>
  </nav>
  <div class="container">
      <div class="jumbotron mt-3">
        <h1>Welcome, <?php echo $user->getName();?></h1>
        
        <p class="lead">My User ID.
        <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $user->getID();?>
                </div>
          </li></p>
        <p class="lead">My Name.
        <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $user->getName();?>
                </div>
          </li></p>
          <p class="lead">My Username.
        <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $user->getuserName();?>
                </div>
          </li></p>
        <a class="btn btn-lg btn-primary" href="edituser.php?id=<?=$user->getID();?>" role="button">Modifier info »</a>
        
        <br></br>
        <?php if($res){ ?>
                <div class="container ">
              <h2 class="display-5"> mes Congés </h2>
              <br></br>
              <ul class="list-group">
                 
                  <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                      <div style="width:90px;">
                      Nom
                      </div>
                      <div style="width:90px;">
                      Durre de Congé
                      </div>
                      <div style="width:90px;">
                      Date debut
                      </div>
                      <div style="width:90px;">
                      Date de Fin
                      </div>
                      <div style="width:90px;">
                      Motif
                      </div>
                      <div style="width:90px;">
                      statut
                      </div>
                      

                    
                      
                  </li>
                  <?php foreach($res as $item){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div style="width:90px;">
                      <?php 
                          
                          echo $user->getName();
                      ?>
                      </div>
                      <div style="width:90px;">
                      <?php 
                          $idm = $PDO->prepare("SELECT DATEDIFF(dateFin,dateDebut) AS difference FROM conge WHERE idEmploye=? ");
                          $idm->execute([$user->getID()]);
                          $nom = $idm->fetchColumn(); // Fetch the difference directly
                          echo $nom;
                          
                      ?>
                      </div>
                      <div style="width:90px;">
                      <?php echo $item['dateDebut']; ?>
                      </div>
                      <div style="width:90px;">
                      <?php echo $item['dateFin']; ?>
                      </div>
                      <div style="width:90px;">
                      <?php echo $item['motif']; ?>
                      </div>
                      <div style="width:90px;">
                      <?php echo $item['statut']; ?>
                      </div>
                      
                      
                      
                      
                    <!-- <span>
                      <a class="btn btn-primary" href="process.php?deletebook=1&ID=<?=$item['BOOK_ID'];?>&CNO=<?=$item['CNO'];?>&Cname=<?=$_GET['Cname'];?>" >DEL</a>
                    </span> -->
                  </li>
                  <?php } ?>
                  <!--<div class="jumbotron mt-3">
                      <a class="btn btn-lg btn-primary" href="addbook.php?CNO=<?=$_GET['CNO'];?>&Cname=<?=$_GET['Cname'];?>" role="button">+</a>
                  </div>-->
              </ul>
          </div>
        <?php  } ?>
            
        </ul>
    </div>
        
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>