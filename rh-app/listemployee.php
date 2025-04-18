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
    echo "Please log in!";
    header("Location: /rh-app/login.php");
    exit;
}
$user = $_SESSION["userData"];
$stm = $PDO->prepare("SELECT * FROM users WHERE user_type is NULL ");
$stm->execute();
$res = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
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
 <div class="container ">
        <h2 class="display-5"><?php echo "Welcome, ".$user->getName();?></h2>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:90px;">
                Employés
                </div>
                <span></span>
                <span>? Operation</span>
                
            </li>
            <?php foreach($res as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $item['Name']; ?>
                </div>
                <span></span>
                
                <span>
                <span><a class="btn btn-primary" href="infoemp.php?id=<?=$item['ID'];?>">Détails</a>
                <a class="btn btn-primary" href="delete.php?deleteuser=1&id=<?=$item["ID"];?>">Supprimer</a></span>
                
                </span>
            </li>
            <?php } ?>
            <div class="jumbotron mt-3">
                <a class="btn btn-lg btn-primary" href="newemp.php" role="button">+</a>
            </div>
        </ul>
   
</body>
</html>