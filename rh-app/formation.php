<?php
include_once 'conn.php';
include_once 'user.php';
  $PDO = DB_conn();
  session_start();

  if(isset($_SESSION["userData"])){
    $user = $_SESSION["userData"];
     if ($user->getusertype()!==NULL){
        header("Location: /rh-app/formation2.php");
       
    }

    }
  else{
        echo "Please log in!";
        header("Location: /rh-app/login.php");
        exit;
    }
    

$user = $_SESSION["userData"];
$stm = $PDO->prepare("SELECT * FROM formation  ");
$stm->execute();
$res = $stm->fetchAll();
$stm = $PDO->prepare("SELECT * FROM formation_participant WHERE idParticipant= ? ");
$stm->execute([$user->getID()]);
$resultat = $stm->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Formation</title>
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
 <div class="container ">
        <h2 class="display-5"><?php echo "Welcome, ".$user->getName();?></h2>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:140px;">
                Formation valable
                </div>
                <span></span>
                <span>? Operation</span>
                
            </li>
            <?php foreach($res as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $item['titre']; ?>
                </div>
                <span></span>
                
                <span>
                <span><a class="btn btn-primary" href="inscrireformation.php?Userid=<?=$user->getID();?>&id=<?=$item['idFormation'];?>">S'inscrire à la formation</a></span>
                <a class="btn btn-primary" href="infoformation.php?details=1&id=<?=$item['idFormation'];?>&titre=<?=$item['titre'];?>" >Détails</a>
                </span>
            </li>
            <?php } ?>
            
        </ul>
    </div>
    <br><br>
    <div class="container ">
        
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:150px;">
                Formation encours
                </div>
                <span></span>
                <span>? Operation</span>
                
            </li>
            <?php foreach($resultat as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                
                <?php 
                    $idm = $PDO->prepare("SELECT * FROM formation WHERE idFormation= ? ");
                    $idm->execute([$item['idFormation']]);
                    $row = $idm->fetch(PDO::FETCH_ASSOC); // Fetching the row as an associative array
                    
                    echo $row['titre'];
                    
                 ?>
                </div>
                <span></span>
                
                <span>
                <span><a class="btn btn-primary" href="infoformation.php?id=<?=$item['idFormation'];?>&titre=<?=$row['titre'];?>">Détails</a></span>
                <a class="btn btn-primary" href="delete.php?delformation=1&id=<?=$item['idFormation'];?>" >Supprimer</a>
                </span>
            </li>
            <?php } ?>
            
        </ul>
    </div>
   
</body>
</html>