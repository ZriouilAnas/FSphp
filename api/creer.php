<?php
require_once '../autoloader.php';

use Modele\Dao\ProduitDao;
use Modele\entite\Produit;
use OpenApi\Annotations as OA;
/**
* @OA\Info(title="Mon API", version="1.0.0")
*/
/**
* @OA\Post(
* path="/LabREST_03/api/produit/new",
* summary="Création d'un produit",
* @OA\Response(
* response=200,
* description="Création d'un produit à partir des données envoyées"
* ),
* @OA\Response(
* response=503,
* description="Le service n'est pas disponible"
* ),
* @OA\Response(
* response="default",
* description="Une erreur non prévue"
* )
* )
*/

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

    $produitDao = new ProduitDao();
    $produit = new Produit();

    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->nom) && !empty($data->description) && !empty($data->prix)){
        $produit->setNom($data->nom);
$produit->setDescription($data->description);
$produit->setPrix($data->prix);
$produit->setDate_creation(date('Y-m-d') );
  $result = $produitDao->create($produit);
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