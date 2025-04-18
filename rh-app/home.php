<?php

include_once 'conn.php';
include_once 'user.php';

    $PDO = DB_conn();
    $stm= $PDO->prepare("SELECT * FROM offre");
    $result=$stm->execute();
    $result=$stm->fetchAll();
    if($result){
       
    }


    
    

?>

<!doctype html>
<html lang="en">
    <head>
    <title>AGRH home page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
   <a class="navbar-brand" href="#">AGRH</a>
   <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02"> <!-- Add justify-content-end to align items to the right -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
         <li class="nav-item align-items-left">
            <a class="nav-link active" href="register.php">
               <button type="button" class="btn btn-primary" type="submit">Register</button>
            </a>
         </li>
         <li class="nav-item align-items-left">
            <a class="nav-link active" href="login.php">
               <button type="button" class="btn btn-primary" type="submit">Log in</button>
            </a>
         </li>
      </ul>
   </div>
</div>


</nav>
    <section class="vh-100 gradient-custom" >
        <div class="container py-5 h-100" >
        <div class="mb-md-5 mt-md-4 pb-5" style="width: 100%;" >
                        <p style="text-align: center; font-size: 24px; color: white;">OFFRE D'EMPLOI</p>
                        <div class="container d-flex justify-content-center " >
        
                            <br></br>
                            <ul class="list-group" style="width: 100%;">
                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary ">
                                    <div style="width:90px; color: purple;">Poste</div>
                                    <div style="width:150px; color: purple;">Description</div>
                                    <div style="width:280px; color: purple;">Date de Publication</div>
                                    <div style="width:90px; color: purple;">?Operation</div>
                                </li>
                                <?php foreach($result as $item){ ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center <?php echo $index % 2 == 0 ? 'bg-dark' : 'bg-purple'; ?>">
                                    <div style="width:90px; color: white;"><?php echo $item['titre']; ?></div>
                                    <div style="width:280px; color: white;"><?php echo $item['description']; ?></div>
                                    <div style="width:280px; color: white;"><?php echo $item['datePublication']; ?></div>
                                    <span>
                                        <a class="btn btn-primary" href="infooffre.php?titre=<?=$item["titre"];?>&idoffre=<?=$item["idOffre"];?>">Détails</a>
                                    </span>
                                </li>
                                <?php } ?>
                            </ul>

                                
                               
                        </div>

                    </div>
        </div>
</section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href = "style.css" rel = "stylesheet">
    </body>
</html>