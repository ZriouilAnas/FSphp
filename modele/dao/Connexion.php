<?php
namespace Modele\Dao;

use PDO;
use PDOException;

class Connexion {
    private $host = 'localhost';
    private $dbname = 'db_labrest';
    private $username = 'root';
    private $password = '';
    private  $connexion;
    
public function getConnexion():mixed{
    try {
    $this->connexion = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,
    $this->username,
    $this->password);
    }catch(PDOException $exception) {
    throw $exception;
    }
    return $this->connexion;
}

}



?>