<?php 

    include_once 'conn.php';
    include_once 'user.php';
    
    
    $PDO = DB_conn();

    

        
   
        
        $stm = $PDO->prepare("SELECT * FROM offre WHERE idOffre=?");
        $stm->execute([$_GET['idoffre']]);
        $result = $stm->fetchAll();
    
    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Details d'Offre d'emploi</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">AGRH</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item align-items-left">
            <a class="nav-link active" href="home.php"><button type="button" class="btn btn-primary" type="submit">GOBACK</button></a>
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
                Offre
                </div>
                <div style="width:280px;">
                Description
                </div>
                <div style="width:90px;">
                Date de Publication
                </div>
                <div style="width:90px;">
                Date d'Expiration'
                </div>
                <div style="width:90px;">
                Departement
                </div>
                <div style="width:90px;">
                lieu
                </div>
                <div style="width:90px;">
                salaire
                </div>
                
               
                
            </li>
            <?php foreach($result as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
           
                <div style="width:90px;">
                <?php echo $item['titre']; ?>
                </div>
                <div style="width:280px;">
                <?php echo $item['description']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['datePublication']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['dateExpiration']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['departement']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['lieu']; ?>
                </div>
                <div style="width:90px;">
                <?php echo $item['salaire']; ?>
                </div>
                
                
                
               <!-- <span>
                <a class="btn btn-primary" href="process.php?deletebook=1&ID=<?=$item['BOOK_ID'];?>&CNO=<?=$item['CNO'];?>&Cname=<?=$_GET['Cname'];?>" >DEL</a>
               </span> -->
            </li>
            <?php } ?>
            <div class="jumbotron mt-3">
                <a class="btn btn-lg btn-primary" href="postuler.php?id=<?=$_GET['idoffre'];?>" role="button">Postuler</a>
            </div>
        </ul>
    </div>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>