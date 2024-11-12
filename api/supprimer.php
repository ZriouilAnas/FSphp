<?php

use OpenApi\Annotations as OA;
/**
* @OA\Info(title="Mon API", version="1.0.0")
*/
/**
* @OA\Delete(
* path="/LabREST_03/api/produit/delete",
* summary="supprission d'un produit",
* @OA\Response(
* response=200,
* description="supprimer un produit à partir d'ID envoyées"
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





require_once '../autoloader.php';

use Modele\Entite\Produit;
//Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");
//◇ Format des données envoyées = JSON
header("Content-Type: application/json; charset=UTF-8");
//◇ Méthode autorisée = GET (GET, POST, PUT ou DELETE)
header("Access-Control-Allow-Methods: DELETE, GET");
//◇ Durée de vie de la requête
header("Access-Control-Max-Age: 3600");
//◇ Entêtes autorisés
header("Access-Control-Allow-Headers: Content-Type, Access-ControlAllow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === "DELETE") {

    $produit = new Produit();

    
    if ( isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        
        
  $result = $produit->delete($id);
        if ($result = 1) {
            http_response_code(200);
            echo json_encode(['message' => "Suppression effectuée"]);    
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