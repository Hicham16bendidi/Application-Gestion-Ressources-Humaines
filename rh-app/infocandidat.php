<?php

include_once 'conn.php';
include_once 'user.php';

    $PDO = DB_conn();
    if(isset($_GET['idf'])){
        $stm= $PDO->prepare("SELECT * FROM formation_participant WHERE idFormation=?");
        $result=$stm->execute([$_GET["idf"]]);
        $result=$stm->fetchAll();
    }else{
        $stm= $PDO->prepare("SELECT * FROM candidat WHERE idOffre=?");
        $result=$stm->execute([$_GET["idoffre"]]);
        $result=$stm->fetchAll();
    }
    
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
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <li class="nav-item align-items-left">
                <a class="nav-link active" href="recrutements.php"><button type="button" class="btn btn-primary" type="submit">GOBACK</button></a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <section class="vh-100 gradient-custom" >
        <div class="container py-5 h-100" >
        <div class="mb-md-5 mt-md-4 pb-5" style="width: 100%;" >
        <?php if(isset($_GET['idoffre'])){ ?>
                        <p style="text-align: center; font-size: 24px; color: white;"><?php echo "Candidats au poste de : ".$_GET['titre'];?> </p>
                        <?php } ?>
                        <?php if(isset($_GET['idf'])){ ?>
                        <p style="text-align: center; font-size: 24px; color: white;"><?php echo "Participant à la formation sur : ".$_GET['titref'];?> </p>
                        <?php } ?>
                        <div class="container d-flex justify-content-center " >
        
                            <br></br>
                            <ul class="list-group" style="width: 100%;">
                            <?php if(isset($_GET['idoffre'])){ ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary ">
                                    <div style="width:90px; color: purple;">Nom</div>
                                    <div style="width:150px; color: purple;">Prenom</div>
                                    <div style="width:280px; color: purple;">E-mail</div>
                                    <div style="width:90px; color: purple;">Adresse</div>
                                    <div style="width:90px; color: purple;">Date de naissance</div>
                                    <div style="width:90px; color: purple;">Experiences</div>
                                    <div style="width:90px; color: purple;">Formations</div>
                                    <div style="width:80px; color: purple;">?Operation</div>
                                </li>
                                
                                <?php foreach($result as $item){ ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center <?php echo $index % 2 == 0 ? 'bg-dark' : 'bg-purple'; ?>">
                                    <div style="width:90px; color: white;"><?php echo $item['nom']; ?></div>
                                    <div style="width:150px; color: white;"><?php echo $item['prenom']; ?></div>
                                    <div style="width:280px; color: white;"><?php echo $item['email']; ?></div>
                                    <div style="width:90px; color: white;"><?php echo $item['adresse']; ?></div>
                                    <div style="width:90px; color: white;"><?php echo $item['dateNaissance']; ?></div>
                                    <div style="width:90px; color: white;"><?php echo $item['experience']; ?></div>
                                    <div style="width:90px; color: white;"><?php echo $item['formation']; ?></div>
                                    
                                    <span>
                                        <a class="btn btn-primary" href="infooffre.php">Détails</a>
                                    </span>
                                </li>
                                <?php } ?><?php } ?>
                                <?php if(isset($_GET['idf'])){ ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary ">
                                    <div style="width:90px; color: purple;">Nom</div>
                                    <div style="width:120px; color: purple;">Prenom</div>
                                    <div style="width:280px; color: purple;">E-mail</div>
                                    
                                </li>
                                <?php foreach($result as $item){ 
                                    $stm= $PDO->prepare("SELECT * FROM users WHERE ID=?");
                                    $res=$stm->execute([$item["idParticipant"]]);
                                    $res=$stm->fetchAll();
                                    foreach($res as $itm){
                                    ?>

                                <li class="list-group-item d-flex justify-content-between align-items-center <?php echo $index % 2 == 0 ? 'bg-dark' : 'bg-purple'; ?>">
                                    <div style="width:250px; color: white;"><?php echo $itm['Name']; ?></div>
                                    <div style="width:180px; color: white;"><?php echo $itm['Prenom']; ?></div>
                                    <div style="width:180px; color: white;"><?php echo $itm['Email']; ?></div>
                                    <span>
                                        
                                    </span>
                                </li>
                                <?php } ?><?php }} ?>
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