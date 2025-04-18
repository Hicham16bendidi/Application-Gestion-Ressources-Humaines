<?php
include_once 'conn.php';
include_once 'user.php';
  $PDO = DB_conn();
  session_start();

  if(isset($_SESSION["userData"])){

    

$user = $_SESSION["userData"];
$stm = $PDO->prepare("SELECT * FROM conge WHERE statut = 'en attente'  ");
$stm->execute();
$res = $stm->fetchAll();
$stm = $PDO->prepare("SELECT * FROM conge WHERE statut <> 'en attente' ");
$stm->execute();
$resultat = $stm->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Liste de Demandes de Congé</title>
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
<div class="container ">
        <h2 class="display-5">Subject: Demades de Congés </h2>
        <br></br>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:300px;">
                Demande Encours
                </div>  
            </li>
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
                <div style="width:180px;">
                ? Operation
                </div>

               
                
            </li>
            <?php foreach($res as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php 
                    $idm = $PDO->prepare("SELECT Name FROM users WHERE ID=? ");
                    $idm->execute([$item['idEmploye']]);
                    $nom = $idm->fetch();
                    echo $nom["Name"];
                ?>
                </div>
                <div style="width:90px;">
                <?php 
                    $idm = $PDO->prepare("SELECT DATEDIFF(dateFin, dateDebut) AS difference FROM conge WHERE idConge=? ");
                    $idm->execute([$item['idConge']]);
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
                <span><a class="btn btn-primary" href="delete.php?approuverconge=1&idconge=<?=$item['idConge'];?>">Approuver</a>
                <a class="btn btn-primary" href="delete.php?refuserconge=1&idconge=<?=$item['idConge'];?>" >Refuser</a>
                </span>
                
                
                
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
    <br></br>
    
    <div class="container ">
        
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:300px;">
                Demande Traiter
                </div>  
            </li>
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
                <div style="width:180px;">
                ? Operation
                </div>

               
                
            </li>
            <?php foreach($resultat as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php 
                    $idm = $PDO->prepare("SELECT Name FROM users WHERE ID=? ");
                    $idm->execute([$item['idEmploye']]);
                    $nom = $idm->fetch();
                    echo $nom["Name"];
                ?>
                </div>
                <div style="width:90px;">
                <?php 
                    $idm = $PDO->prepare("SELECT DATEDIFF(dateFin, dateDebut) AS difference FROM conge WHERE idConge=? ");
                    $idm->execute([$item['idConge']]);
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
                <span><a class="btn btn-primary" href="delete.php?cancelconge=1&idconge=<?=$item['idConge'];?>">Cancel</a>
                <a class="btn btn-primary" href="delete.php?delconge=1&idconge=<?=$item['idConge'];?>" >Supprimer</a>
                </span>
                
                
                
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
    
   
</body>
</html>