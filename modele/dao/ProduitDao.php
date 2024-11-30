<?php

namespace modele\dao;
use modele\dao\Connexion;
use PDO;
class ProduitDao  {
    private  $connexion; 
    public function __construct() {
       
        $connexion = new Connexion();
        $this->connexion = $connexion->getConnexion();    
    }
    
public function create($produit){
    $sql = "INSERT INTO t_produit SET nom:nom,description:description,prix:prix,date_creation:date_creation";
    
    $sqlState = $this->connexion->prepare($sql);
    $sqlState->bindParam(":nom", $produit->getNom());
    $sqlState->bindParam(":description", $produit->getDescription());
    $sqlState->bindParam(":prix", $produit->getPrix());
    $sqlState->bindParam(":date_creation", $produit->getDate_creation());
     return $sqlState->execute();
    
}
public function findAll(){
    
     return $this->connexion->query('SELECT * FROM `t_produit`')->fetchAll(PDO::FETCH_ASSOC);
}
public function findById($id){
    $sqlState = $this->connexion->prepare('SELECT * FROM `t_produit` WHERE id=?');
     $sqlState->execute([$id]); 
     $sqlState->setFetchMode(PDO::FETCH_ASSOC) ;
     return $sqlState->fetch();
}
public function delete($id){
    $sqlState = $this->connexion->prepare('DELETE FROM t_produit WHERE id=?');
     $sqlState->execute([$id]);
}
public function update($produit){
    $sql = 'nom = ? ,';
    $sql = $sql.'description = ? ,';
    $sql = $sql.'prix = ? ,';
    $sql = $sql.'date_creation = ?';
    $sql = $sql.'WHERE id = ?';
    $sqlState = $this->connexion->prepare("UPDATE t_produit SET $sql");        
    return $sqlState->execute([
        $produit->nom,
        $produit->description,
        $produit->prix,
        $produit->date_creation
    ]);
}
}