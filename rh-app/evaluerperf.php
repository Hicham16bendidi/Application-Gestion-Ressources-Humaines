<?php
include_once 'conn.php';
include_once 'user.php';
  $PDO = DB_conn();
  session_start();

  if(isset($_SESSION["userData"])){
    $user = $_SESSION["userData"];
     if ($user->getusertype()==NULL){
        header("Location: /rh-app/userpage.php");
       
    }

    }
  else{
        echo "Please log in!";
        header("Location: /rh-app/login.php");
        exit;
    }
    

    if(isset($_POST['Register'])){

        
        $idm = $PDO->prepare("SELECT ID FROM users WHERE Name=? ");
        $idm->execute([$_POST['employee_name']]);
        $id = $idm->fetchColumn(); // Fetch the difference directly
        

          $stm = $PDO->prepare("INSERT INTO performance_evaluation (user_id, evaluation_period,  objectives) VALUES (?,?,?)");
          $result = $stm->execute([$id,$_POST['evaluation_period'],$_POST['objectives']]);
          var_dump($result);

          if($result){
            
              echo "Objectives Crée !";
          
        }else{
            echo "SOMETHING IS WRONG  !";
        }


        }  
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Evaluation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php  if($user->getusertype()=='respo') { ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">AGRH</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="listemployee.php"><button type="button" class="btn btn-primary" type="submit">+ Employés</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="recrutements.php"><button type="button" class="btn btn-primary" type="submit">Recrutement</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="formation2.php"><button type="button" class="btn btn-primary" type="submit">Formations</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="listconge.php"><button type="button" class="btn btn-primary" type="submit">liste de Congés</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="evaluerperf.php"><button type="button" class="btn btn-primary" type="submit">Evaluation de performances</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="respopage.php"><button type="button" class="btn btn-primary" type="submit">Moi</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="logout.php"><button type="button" class="btn btn-primary" type="submit">Logout</button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } ?>
<?php  if($user->getusertype()=='admin') { ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">AGRH</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item align-items-left">
            <a class="nav-link active" href="admnpage.php"><button type="button" class="btn btn-primary" type="submit">Users</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="recrutements.php"><button type="button" class="btn btn-primary" type="submit">Recrutement</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="formation2.php"><button type="button" class="btn btn-primary" type="submit">Formations</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="listconge.php"><button type="button" class="btn btn-primary" type="submit">liste de Congés</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="evaluerperf.php"><button type="button" class="btn btn-primary" type="submit">Evaluation de performances</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="infoadmin.php"><button type="button" class="btn btn-primary" type="submit">Moi</button></a>
        </li>
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="logout.php"><button type="button" class="btn btn-primary" type="submit">Logout</button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } ?>
<div class="container mt-5">
    <h1 class="mb-4">Taches et Objectives .</h1>

    <!-- Form for Evaluation -->
    <form action="evaluerperf.php" method="post">
        <div class="form-group">
            <label for="employee_name">Nom de l'employé :</label>
            <input type="text" class="form-control" id="employee_name" name="employee_name">
        </div>
        <div class="form-group">
            <label for="evaluation_period">Période de l'évaluation :</label>
            <input type="text" class="form-control" id="evaluation_period" name="evaluation_period">
        </div>
        <div class="form-group">
            <label for="objective1">Objectif  :</label>
            <input type="text" class="form-control" id="objective1" name="objectives">
        </div>
        <!-- Ajouter des champs pour les autres objectifs -->
        <button type="submit" class="btn btn-primary" name="Register">Soumettre</button>
    </form>

</div>

</body>
</html>
