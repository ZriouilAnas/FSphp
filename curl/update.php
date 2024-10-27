<?php
// Define the URL for the update request, appending the product ID in the URL
$id = 2; // Product ID to be updated
$url = "http://localhost/LabREST_03/api/v1.0/produit/update/$id"; // Assuming the API accepts the ID as part of the URL

// Data to be sent in the PUT request (excluding the ID from the body)
$data = json_encode(array(
    'nom' => 'jjaa',
    'description' => 'jjaa',
    'prix' => 20,
    'date_creation' => date("Y-m-d") // Correctly set the current date
));

// Initialize a cURL session
$ch = curl_init();

// Set cURL options for the PUT request
curl_setopt($ch, CURLOPT_URL, $url); // Set the URL with the ID
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Specify PUT method
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Pass the JSON data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json', // Set the content type to JSON
    'Content-Length: ' . strlen($data) // Ensure the correct content length is sent
));

// Execute the cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    echo 'CURL Error: ' . curl_error($ch);
} else {
    // Decode the JSON response
    $decode = json_decode($response, true);

    // Output the decoded response
    if (is_array($decode)) {
        foreach ($decode as $key => $value) {
            echo "$key: $value<br>";
        }
    } else {
        // Handle non-JSON responses
        echo $response;
    }
}

// Close the cURL session
curl_close($ch);
?>
