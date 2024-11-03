<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Request Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Styling/USER_STYLING.css">
    </head>
<body>

    <!-- This creates a Sidebar -->
    <div class="sidebar">
        <h2>IT Helpdesk</h2>
        <a href="User_Requests.php">View Your Requests</a>
        <a href="User_Send_Request.html">Send a Request</a>
        <a href="User_Responses.php">Response</a>
    </div>

    <!-- Main content area -->
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // This checks if the form has been submitted 
                $user_email = $_POST['email'] ?? '';
                $file = 'data.json';

                // This reads the data from the JSON file
                $jsonData = file_get_contents($file);
                $requests = json_decode($jsonData, true);
                $found = false;

                // This loops through all requests to find exact same matches for the user's email
                echo "<div class='mt-4'>";
                echo "<h4 class='text-muted'>Request Details</h4>";
                foreach ($requests as $request) {
                    if ($request['email'] === $user_email) {
                        $found = true;   // The code below creates the table if the email written in the textbox matches the form from the email that has been answered.
                        echo "<div class='mb-4 p-3 border rounded'>";
                        echo "<p><strong>First Name:</strong> " . htmlspecialchars($request['firstname']) . "</p>";
                        echo "<p><strong>Last Name:</strong> " . htmlspecialchars($request['lastname']) . "</p>";
                        echo "<p><strong>Description:</strong> " . htmlspecialchars($request['description']) . "</p>";
                        echo "<p><strong>Priority:</strong> " . htmlspecialchars($request['priority']) . "</p>";
                        echo "<p><strong>Timestamp:</strong> " . (isset($request['timestamp']) ? htmlspecialchars($request['timestamp']) : "No timestamp available") . "</p>";
                        echo "<p><strong>Response from IT:</strong> " . (!empty($request['response']) ? htmlspecialchars($request['response']) : "No response yet") . "</p>";
                        echo "</div>";
                    }
                }
                
                // This is run if no request was found for the email,
                if (!$found) {
                    echo "<p class='text-danger mt-4'>No requests found for this email.</p>";
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
