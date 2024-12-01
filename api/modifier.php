<?php
require_once '../autoloader.php';

use Modele\Dao\ProduitDao;
use Modele\entite\Produit;
use OpenApi\Annotations as OA;
/**
* @OA\Info(title="Mon API", version="1.0.0")
*/
/**
* @OA\Put(
* path="/LabREST_03/api/produit/update",
* summary="Modifier d'un produit",
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

// Allow access from any site or device (*)
header("Access-Control-Allow-Origin: *");
// Data format sent = JSON
header("Content-Type: application/json; charset=UTF-8");
// Authorized method = PUT
header("Access-Control-Allow-Methods: PUT");
// Max age of the request
header("Access-Control-Max-Age: 3600");
// Allowed headers
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    // Check if the product ID is passed via the URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id']; // Retrieve the product ID from the URL

        // Instantiate the Product class
        $produitDao = new ProduitDao();
        $produit = new Produit();
        // Get the input data from the request body
        $data = json_decode(file_get_contents("php://input"));

        // Validate the required fields
        if (!empty($data->nom) && !empty($data->description) && !empty($data->prix)) {
            
            // Set the updated product information
            $produit->setId($id);
            $produit->setNom($data->nom);
            $produit->setDescription($data->description);
            $produit->setPrix($data->prix);
            $produit->setDate_creation(date('Y-m-d'));

            // Update the product with the provided ID
            $result = $produitDao->update($produit);

            // Check if the update was successful
            if ($result === true) {
                http_response_code(200);
                echo json_encode(['message' => "Modification effectuée"]);
            } else {
                http_response_code(503);
                echo json_encode(['message' => "Impossible de traiter la requête, produit non trouvé"]);
            }
        } else {
            // Missing data in the request body
            http_response_code(400); // Bad request
            echo json_encode(['message' => "Données incomplètes pour la modification"]);
        }
    } else {
        // Missing or invalid product ID
        http_response_code(400); // Bad request
        echo json_encode(['message' => "ID du produit manquant ou invalide"]);
    }
} else {
    // Method not allowed (if not PUT)
    http_response_code(405);
    echo json_encode(["message" => "Méthode non autorisée"]);
}
?>
