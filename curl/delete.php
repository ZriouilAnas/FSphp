<?php
// Définir l’URL
$id = 2;
$url = "http://localhost/LabREST_03/api/v1.0/produit/delete/.$id";
// Donnée à transmettre au format JSON : id du produit à supprimer
$data = json_encode(array('id' => $id));
// Initialiser une session CURL
$ch = curl_init();
// Définir les options de transmission CURL : url, méthode, données, …
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
// Exécuter la session CURL et récupérer la réponse
$response = curl_exec($ch);
// Afficher la réponse du service WEB REST
var_dump($response);
// Fermer la session CURL
curl_close($ch);
?>