<?php
class Candidat {
    private $idCandidat;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $adresse;
    private $dateNaissance;
    private $experience;
    private $formation;
    private $idOffre;

    // Constructeur
    public function __construct($nom, $prenom, $email, $telephone, $adresse, $dateNaissance, $experience, $formation,$idOffre) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->dateNaissance = $dateNaissance;
        $this->experience = $experience;
        $this->formation = $formation;
        $this->idOffre=$idOffre;
    }

    // Getters et setters
    public function getIdCandidat() {
        return $this->idCandidat;
    }

    public function setIdCandidat($idCandidat) {
        $this->idCandidat = $idCandidat;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    public function getExperience() {
        return $this->experience;
    }

    public function setExperience($experience) {
        $this->experience = $experience;
    }

    public function getFormation() {
        return $this->formation;
    }

    public function setFormation($formation) {
        $this->formation = $formation;
    }
    public function getidOffre() {
        return $this->idOffre;
    }
}

?>