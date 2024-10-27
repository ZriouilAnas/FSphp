<?php
require_once '..\modele\entite\Produit.php';

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
        $produit = new Produit();

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
