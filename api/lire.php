<?php



require_once '..\modele\entite\Produit.php';


//Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");
//◇ Format des données envoyées = JSON
header("Content-Type: application/json; charset=UTF-8");
//◇ Méthode autorisée = GET (GET, POST, PUT ou DELETE)
header("Access-Control-Allow-Methods: GET");
//◇ Durée de vie de la requête
header("Access-Control-Max-Age: 3600");
//◇ Entêtes autorisés
header("Access-Control-Allow-Headers: Content-Type, Access-ControlAllow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $produit = new Produit();

    // Récupération des données
    $statement = $produit->findAll();
    
    if ($statement) {
        $data = [];

        $data[] = $statement;


        // on renvoie ses données sous format json
        http_response_code(200);
        echo json_encode($data);
    } else {
        echo json_encode(["message" => "Aucune données à renvoyer"]);
    }

} else {
    echo json_encode(["message" => "Méthode non autorisée"]);

}
    
    
    


    ?>