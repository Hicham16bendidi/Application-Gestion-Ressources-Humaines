<?php
    include_once 'conn.php';
    include_once 'user.php';
      $PDO = DB_conn();
      session_start();
    
      if(isset($_SESSION["userData"])){
        $user = $_SESSION["userData"] ;
        $stm = $PDO->prepare("SELECT * FROM formation_participant WHERE idFormation= ? and idParticipant=?");
        $stm->execute([$_GET["id"],$_GET["Userid"]]);
        $resultat=$stm->fetchAll();
        if($resultat){
            $alert_message = "Déja inscrit !!!";
            echo "<script>alert('" . $alert_message . "');</script>";
            
        }else{
        $stm = $PDO->prepare("INSERT INTO formation_participant VALUES (?,?)");
        $stm->execute([$_GET["id"],$_GET["Userid"]]);
        header("Location: /rh-app/formation.php");
        }
    }

?>