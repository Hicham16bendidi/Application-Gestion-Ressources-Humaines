<?php

class user{

    private $ID;
    private $Name;
    private $Username;
    private $user_type;
    private $Password;

    public function __construct($id, $name, $username,$type, $pass){

        $this->ID = $id;
        $this->Name = $name;
        $this->Username = $username;
        $this->user_type = $type;
        $this->Password = $pass;
    }
    public function getName(){
        return $this->Name;

    } 
    public function getID(){
        return $this->ID;

    }
    public function getuserName(){
        return $this->Username;

    }
    public function getpassword(){
        return $this->Password;
    }
    public function getusertype(){
        return $this->user_type;
    }
}
class employe extends user {
    private $email;
    private $telephone;
    private $prenom;
    private $departement;
    private $poste;
    private $salaire;

    public function __construct($prenom,$email, $telephone,
     $departement, $poste, $salaire) {
        $this->email = $email;
        $this->telephone = $telephone;
        $this->prenom = $prenom;
        $this->departement = $departement;
        $this->poste = $poste;
        $this->salaire = $salaire;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTelephone() {
        return $this->telephone;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function getDepartement() {
        return $this->departement;
    }
    public function getPoste() {
        return $this->poste;
    }
    public function getSalaire() {
        return $this->salaire;
    }
}
?>