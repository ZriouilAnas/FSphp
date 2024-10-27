<?php
include 'C:\xampp\htdocs\LabREST_03\modele\dao\Connexion.php';
class Produit extends Connexion {
// Attributs

private $nom;
private $description;
private $prix;
private $date_creation;





public function create(){
    $sqlState = $this->database()->prepare("INSERT INTO t_produit VALUES(NULL,?,?,?,?) ");
    return $sqlState->execute([
        $this->nom,
        $this->description,
        $this->prix,
        $this->date_creation,
    ]);
    
}
public function findAll(){
    
     return $this->database()->query('SELECT * FROM `t_produit`')->fetchAll(PDO::FETCH_ASSOC);
}
public function findById($id){
    $sqlState = $this->database()->prepare('SELECT * FROM `t_produit` WHERE id=?');
     $sqlState->execute([$id]); 
     $sqlState->setFetchMode(PDO::FETCH_ASSOC) ;
     return $sqlState->fetch();
}
public function delete($id){
    $sqlState = $this->database()->prepare('DELETE FROM t_produit WHERE id=?');
     $sqlState->execute([$id]);
}
public function update($id){
    

    
    $sql = 'nom = ? ,';
    $sql = $sql.'description = ? ,';
    $sql = $sql.'prix = ? ,';
    $sql = $sql.'date_creation = ?';
    $sql = $sql.'WHERE id = ?';

    $sqlState = $this->database()->prepare("UPDATE t_produit SET $sql");
                                       
    return $sqlState->execute([
        $this->nom,
        $this->description,
        $this->prix,
        $this->date_creation,
        $id
    ]);
}







/**
 * Get the value of nom
 */ 
public function getNom()
{
return $this->nom;
}

 
public function setNom($nom)
{
$this->nom = $nom;

return $this;
}

/**
 * Get the value of description
 */ 
public function getDescription()
{
return $this->description;
}

 
public function setDescription($description)
{
$this->description = $description;

return $this;
}

/**
 * Get the value of prix
 */ 
public function getPrix()
{
return $this->prix;
}

 
public function setPrix($prix)
{
$this->prix = $prix;

return $this;
}

/**
 * Get the value of date_creation
 */ 
public function getDate_creation()
{
return $this->date_creation;
}

 
public function setDate_creation($date_creation)
{
$this->date_creation = $date_creation;

return $this;
}
}
?>