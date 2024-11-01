<!-- process.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $firstname = htmlspecialchars($_POST['firstname']);
    # htmlspecialchars-converts special characters to HTML
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $description = htmlspecialchars($_POST['description']);
    $priority = htmlspecialchars($_POST['priority']);
    $timestamp = date("Y-m-d H:i:s");
    // Create an associative array to store the form data
    $formData = array(
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "description" => $description,
        "priority"=> $priority,
        "timestamp" => $timestamp

    );
    #form data which is used to keep form data
    # has a key-value pair
    #the keys are first name,lastname and email.

    // Convert the data to JSON format and save it to a file (e.g., 'data.json')
    $file = 'data.json';
    $currentData = array();

    # this converts the form data into json format and then
    # stores the data into a JSON file.
    # and $curretnData is an empty array that will contain
    # the data from the form

    // If the file exists, read the current data
    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $currentData = json_decode($jsonData, true);
    }

    #this checks that if data.json already exists
    # if it does, it puts the contents into a string
    # the json_decode($jsonData, true) makes the
    # JSON string into a php array


    // Append the new form data to the existing data
    $currentData[] = $formData;

    # this line adds the current data to the form data 
    # which allows us to save all the data instead of 
    #overwritting it.


    // Save the updated data back to the JSON file
    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));

    // Redirect to the display page to show the stored data
    header("Location: User_Requests.php");
    exit();
}
?>
