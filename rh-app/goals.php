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

    $stm = $PDO->prepare("SELECT * FROM performance_evaluation WHERE user_id=?");
    $stm->execute([$user->getID()]);
    $result = $stm->fetchAll();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Evaluation - Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<div class="container mt-5">
    <h1 class="mb-4">Performance Evaluation - Employee</h1>

    <!-- Display Evaluation -->
    <div class="card mb-4">
        
        <div class="card-header"></div>
        <div class="card-body">
            <p><strong>Nom de l'employé :</strong> 
                    <?php 
                    $idm = $PDO->prepare("SELECT Name FROM users WHERE ID=? ");
                    $idm->execute([$result['user_id']]);
                    $nom = $idm->fetch();
                    echo $nom["Name"];?> </p>
            <p><strong>Période de l'évaluation :</strong> <?php echo $result['evaluation_period']; ?> </p>
            <p><strong>Objectif :</strong>  <?php echo $result['objectives']; ?></p> 
            
        </div>
        
    </div>

</div>

</body>
</html>
