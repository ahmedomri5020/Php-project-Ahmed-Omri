<?php
class Customer {
    private $CIN;
    private $password;
    private $name;
    private $adresse;
    private $contactinfo;

    public function __construct($CIN = "", $password = "", $name = "", $adresse = "", $contactinfo = "") {
        $this->password = $password;
        $this->CIN = $CIN;
        $this->name = $name;
        $this->adresse = $adresse;
        $this->contactinfo = $contactinfo;
    }

    public function getCIN() {
        return $this->CIN;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAdresse() {
        return $this->adresse;
    }
    public function setCIN($CIN) {
        $this->CIN = $CIN;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getContactinfo() {
        return $this->contactinfo;
    }

    public function setContactinfo($contactinfo) {
        $this->contactinfo = $contactinfo;
    }
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

?>