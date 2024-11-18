<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Responses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Styling/User_Styling.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>IT Helpdesk</h2>
        <a href="User_Requests.php">View Your Requests</a>
        <a href="User_Send_Request.html">Send a Request</a>
        <a href="User_Responses.php">Response</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="form-container text-center">
            <h2>Check Your Request Status</h2>
            <p class="text-muted mb-4">Enter your email to view your current requests and any responses from IT support.</p>
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Enter your email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                <button type="submit" class="btn btn-primary">Check Status</button>
            </form>

            <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if the form is submitted
    $user_email = $_POST['email'] ?? '';
    $responsesFile = '../Forms/user_responses.json';

    echo "<div class='mt-4'>";
    echo "<h4 class='text-muted'>Your Responses</h4>";

    // Check if the file exists and is readable
    if (file_exists($responsesFile) && is_readable($responsesFile)) {
        $responseDataFile = file_get_contents($responsesFile);
        $responses = json_decode($responseDataFile, true);
        
        if ($responses === null) {
            echo "<p class='text-warning'>Error: Unable to process responses. Please try again later.</p>";
        } else {
            $found = false;

            // Loop through the responses and display them
            foreach ($responses as $response) {
                if ($response['email'] === $user_email) {
                    $found = true;   // User's response found, now display

                    echo "<div class='mb-4 p-3 border rounded'>";
                    echo "<p><strong>First Name:</strong> " . htmlspecialchars($response['firstname']) . "</p>";
                    echo "<p><strong>Last Name:</strong> " . htmlspecialchars($response['lastname']) . "</p>";
                    echo "<p><strong>Description:</strong> " . htmlspecialchars($response['description']) . "</p>";
                    echo "<p><strong>Response:</strong> " . htmlspecialchars($response['response']) . "</p>";
                    echo "<p><strong>Timestamp:</strong> " . htmlspecialchars($response['response_timestamp']) . "</p>";
                    echo "</div>";
                }
            }

            if (!$found) {
                echo "<p class='text-danger mt-4'>No responses found for this email.</p>";
            }
        }
    } else {
        echo "<p class='text-warning'>Error: Responses data file not found or not accessible.</p>";
    }
    echo "</div>";
}
?>

        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
