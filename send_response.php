<?php
$file = 'data.json';
$response = $_POST['response'] ?? '';
$user_email = $_POST['user_email'] ?? '';

// Only proceed if there's a response and user email
if ($response && $user_email) {
    // Read the existing data
    $jsonData = file_get_contents($file);
    $requests = json_decode($jsonData, true);

    // Update the response for the user by email
    foreach ($requests as &$request) {
        if ($request['email'] === $user_email) {
            $request['response'] = $response; // Save response
            $request['response_timestamp'] = date('Y-m-d H:i:s'); // Add the current timestamp for the response
            break;
        }
    }

    // Write the updated data back
    file_put_contents($file, json_encode($requests, JSON_PRETTY_PRINT));

    // Redirect back to the support page after saving
    header("Location: IT_Respond.php");
    exit(); 
}
?>
