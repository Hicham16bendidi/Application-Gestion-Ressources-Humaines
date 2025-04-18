<?php

include_once 'conn.php';

$PDO = DB_conn();

if (isset($_GET['deleteuser'])){
    $stm = $PDO->prepare("DELETE FROM conge WHERE idEmploye=?");
    $stm->execute([$_GET['id']]);
    $stm = $PDO->prepare("DELETE FROM formation_participant WHERE idParticipant=?");
    $stm->execute([$_GET['id']]);
    $stm = $PDO->prepare("DELETE FROM employe WHERE ID=?");
    $stm->execute([$_GET['id']]);
    $stm = $PDO->prepare("DELETE FROM users WHERE ID=?");
    $stm->execute([$_GET['id']]);
    header("Location: /rh-app/admnpage.php");
    exit;

}
if (isset($_GET['delformation'])){

    
    $stm = $PDO->prepare("DELETE FROM formation_participant WHERE idFormation=?");
    $stm->execute([$_GET['id']]);
    header("Location: /rh-app/formation.php");
    exit;

}
if (isset($_GET['refuserconge'])){

    
    $stm = $PDO->prepare("UPDATE conge SET statut='refusé' WHERE idConge=?");
    $stm->execute([$_GET['idconge']]);
    header("Location: /rh-app/listconge.php");
    exit;

}
if (isset($_GET['approuverconge'])){

    
    $stm = $PDO->prepare("UPDATE conge SET statut='Approuvé' WHERE idConge=?");
    $stm->execute([$_GET['idconge']]);
    header("Location: /rh-app/listconge.php");
    exit;

}
if (isset($_GET['cancelconge'])){

    
    $stm = $PDO->prepare("UPDATE conge SET statut='en attente' WHERE idConge=?");
    $stm->execute([$_GET['idconge']]);
    header("Location: /rh-app/listconge.php");
    exit;

}
if (isset($_GET['delconge'])){

    
    $stm = $PDO->prepare("DELETE FROM conge WHERE idConge=?");
    $stm->execute([$_GET['idconge']]);
    header("Location: /rh-app/listconge.php");
    exit;

}
if (isset($_GET['deloffre'])){
    $stm = $PDO->prepare("DELETE FROM candidat WHERE idOffre=?");
    $stm->execute([$_GET['idoffre']]);
    $stm = $PDO->prepare("DELETE FROM offre  WHERE idOffre=?");
    $stm->execute([$_GET['idoffre']]);
    header("Location: /rh-app/recrutements.php");
    exit;
}


?>