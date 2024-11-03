<?php
header('Content-Type: application/json'); // Set the content type to JSON

$file = 'data.json';
$response = $_POST['response'] ?? '';
$user_email = $_POST['user_email'] ?? '';

if ($response && $user_email) {
    // This reads the existing data
    $jsonData = file_get_contents($file);
    $requests = json_decode($jsonData, true);

    // This updates the response for the user by email
    foreach ($requests as &$request) {
        if ($request['email'] === $user_email) {
            $request['response'] = $response; // Save response
            $request['response_timestamp'] = date('Y-m-d H:i:s'); // Add timestamp
            break;
        }
    }

    // This puts the updated data back
    if (file_put_contents($file, json_encode($requests, JSON_PRETTY_PRINT))) {
        // This returns a success response as JSON
        echo json_encode(['success' => true]);
    } else {
        // This will print if there is a fail.
        echo json_encode(['success' => false, 'error' => 'Failed to save response']);
    }
} else {
    // This prints when there is invalid input data
    echo json_encode(['success' => false, 'error' => 'Invalid response or email']);
}
?>
