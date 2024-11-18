<?php
header('Content-Type: application/json'); // Set the content type to JSON

// Get the response and user email from the POST request, or set them to empty if not provided
$response = isset($_POST['response']) ? $_POST['response'] : '';
$user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';

// Check if both response and email are provided
if (empty($response) || empty($user_email)) {
    echo json_encode(['success' => false, 'error' => 'Invalid response or email']);
    exit; // Stop the script if any required input is missing
}

// File paths for the JSON files
$requestsFile = '../Forms/data.json';
$responsesFile = '../Forms/user_responses.json';

// Read the data from the JSON files
$requests = json_decode(file_get_contents($requestsFile), true);
$responses = json_decode(file_get_contents($responsesFile), true);

// Flag to check if the request for this email exists
$found = false;

// Look through the requests to find the one that matches the user's email
foreach ($requests as $key => $request) {
    if ($request['email'] == $user_email) {
        $found = true;

        // Add the response and timestamp to the request
        $requests[$key]['response'] = $response;
        $requests[$key]['response_timestamp'] = date('Y-m-d H:i:s');

        // Create the response data to add to user_responses.json
        $newResponse = [
            'email' => $user_email,
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'description' => $request['description'],
            'response' => $response,
            'response_timestamp' => date('Y-m-d H:i:s')
        ];

        // Remove the request from the list after processing it
        unset($requests[$key]);
        break; // Exit the loop once we find the matching request
    }
}

// If the user's request was found and the response was added
if ($found) {
    // Reindex the array to reset the keys
    $requests = array_values($requests);

    // Save the updated requests back to data.json
    if (file_put_contents($requestsFile, json_encode($requests, JSON_PRETTY_PRINT))) {
        // Add the new response to the user_responses array and save it to user_responses.json
        $responses[] = $newResponse;
        if (file_put_contents($responsesFile, json_encode($responses, JSON_PRETTY_PRINT))) {
            echo json_encode(['success' => true]); // Success response
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to save response to user_responses.json']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update data.json']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Request not found for this email']);
}
?>
