<?php 

    include_once 'conn.php';
    include_once 'user.php';
    
    $PDO = DB_conn();

    session_start();

    if(isset($_SESSION["userData"])){

        
    if(isset($_GET['id'])){
        
        $user = $_SESSION["userData"];
        $stm = $PDO->prepare("SELECT * FROM formation WHERE idFormation=?");
        $stm->execute([$_GET['id']]);
        $result = $stm->fetchAll();
    }}
    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Details de Formations</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">AGRH</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="formation.php"><button type="button" class="btn btn-primary" type="submit">GOBACK</button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <br></br>
    <div class="container ">
        <h2 class="display-5"><?php echo "Subject: ".$_GET['titre'];?></h2>
        <br></br>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:90px;">
                Formation ID
                </div>
                <div style="width:150px;">
                Titre de Formation
                </div>
                <div style="width:280px;">
                Description
                </div>
                <div style="width:90px;">
                Date de début
                </div>
                <div style="width:90px;">
                Date de Fin
                </div>
               
                
            </li>
            <?php foreach($result as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $item['idFormation']; ?>
                </div>
                <div style="width:150px;">
                <?php echo $item['titre']; ?>
                </div>
                <div style="width:280px;">
                <?php echo $item['description']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['dateDebut']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['dateFin']; ?>
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


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>