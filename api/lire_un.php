<?php

use OpenApi\Annotations as OA;
/**
* @OA\Info(title="Mon API", version="1.0.0")
*/
/**
* @OA\Get(
* path="/LabREST_03/api/produit/listone",
* summary="affichage d'un produit",
* @OA\Response(
* response=200,
* description="affichage d'un produit à partir d'ID envoyées"
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

// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");
// Format des données envoyées = JSON
header("Content-Type: application/json; charset=UTF-8");
// Méthode autorisée = GET (GET, POST, PUT ou DELETE)
header("Access-Control-Allow-Methods: GET");
// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");
// Entêtes autorisés
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    // Verify if the 'id' parameter exists in the URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Retrieve the product ID from the URL query parameters
        $id = $_GET['id'];

        // Initialize the Produit class
        $produit = new Produit;

        // Find the product by ID
        $statement = $produit->findById($id);

        if ($statement) {
            // Send response as JSON
            http_response_code(200);
            echo json_encode($statement);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Produit n’existe pas"]);
        }
    } else {
        // Send a 400 Bad Request response if the ID is missing or invalid
        http_response_code(400);
        echo json_encode(['message' => "ID du produit manquant ou invalide"]);
    }

} else {
    // Send a 405 Method Not Allowed response for unsupported methods
    http_response_code(405);
    echo json_encode(["message" => "Méthode non autorisée"]);
}
?>
