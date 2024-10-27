<?php
require_once '..\modele\entite\Produit.php';
//Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");
//◇ Format des données envoyées = JSON
header("Content-Type: application/json; charset=UTF-8");
//◇ Méthode autorisée = GET (GET, POST, PUT ou DELETE)
header("Access-Control-Allow-Methods: POST");
//◇ Durée de vie de la requête
header("Access-Control-Max-Age: 3600");
//◇ Entêtes autorisés
header("Access-Control-Allow-Headers: Content-Type, Access-ControlAllow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $produit = new Produit();

    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->nom) && !empty($data->description) && !empty($data->prix)){
        $produit->setNom($data->nom);
$produit->setDescription($data->description);
$produit->setPrix($data->prix);
$produit->setDate_creation(date('Y-m-d') );
  $result = $produit->create();
        if ($result = 1) {
            http_response_code(200);
            echo json_encode(['message' => "Creation effectuée"]);    
        } else {
            http_response_code(503);
            echo json_encode(['message' => "Impossible de traiter la requête"]);
        }


    } else {
        http_response_code(204);
        echo json_encode(['message' => "Info incoplete"]);
        
    }



} else {
    http_response_code(405);
    echo json_encode(["message" => "Méthode non autorisée"]);
}

?>