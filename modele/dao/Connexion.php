<?php

class Connexion {
    private $id;
    protected $db;
    /**
 * Get the value of id
 */ 
public function getId()
{
return $this->id;
}

 
public function setId($id)
{
$this->id = $id;

return $this;
}
    public  function database(){
    if (is_null($this->db)) {
        $this->db = new PDO(dsn: 'mysql:host=localhost;dbname=db_labrest',username: 'root',password:'');
    }
    return $this->db;

   
}}



?>