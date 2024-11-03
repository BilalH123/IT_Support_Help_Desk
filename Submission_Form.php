<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // This obtains the form data
    $firstname = htmlspecialchars($_POST['firstname']);
    # htmlspecialchars-converts special characters to HTML
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $description = htmlspecialchars($_POST['description']);
    $priority = htmlspecialchars($_POST['priority']);
    $timestamp = date("Y-m-d H:i:s");
    // This creates an associative array to store the form data
    $formData = array(
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "description" => $description,
        "priority"=> $priority,
        "timestamp" => $timestamp

    );


    // This converts the data to JSON format and save it to a file ('data.json')
    $file = 'data.json';
    $currentData = array();

   

    // If the file exists, It reads the current data
    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $currentData = json_decode($jsonData, true);
    }

 

    // Join the new form data to the existing data
    $currentData[] = $formData;



    //It saves the updated data back to the JSON file
    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));

    // This Redirects us to the display page to show the stored data after the file runs.
    header("Location:../UserEnd/User_Requests.php");
    exit();
}
?>
