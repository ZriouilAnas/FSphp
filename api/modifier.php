<?php
require_once '..\modele\entite\Produit.php';

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
        $produit = new Produit();

        // Get the input data from the request body
        $data = json_decode(file_get_contents("php://input"));

        // Validate the required fields
        if (!empty($data->nom) && !empty($data->description) && !empty($data->prix)) {
            
            // Set the updated product information
            $produit->setNom($data->nom);
            $produit->setDescription($data->description);
            $produit->setPrix($data->prix);
            $produit->setDate_creation(date('Y-m-d'));

            // Update the product with the provided ID
            $result = $produit->update($id);

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
