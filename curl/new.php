
<?php
// Définir l’URL
$url = "http://localhost/LabREST_03/api/v1.0/produit/new/";
// Donnée à transmettre au format JSON : id du produit à supprimer
$data = json_encode(array('nom' => 'jjaa',
                                'description' => 'jjaa','prix' => 20, 'date_creation' => '(date("Y-m-d")'
));
// Initialiser une session CURL
$ch = curl_init();
// Définir les options de transmission CURL : url, méthode, données, …
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Exécuter la session CURL et récupérer la réponse
$response = curl_exec($ch);
// Afficher la réponse du service WEB REST
var_dump($response);

$decode = json_decode($response);
foreach($decode as $key => $x) {
    echo $key . ':'. $x;
}

// Fermer la session CURL
curl_close($ch);
?>




