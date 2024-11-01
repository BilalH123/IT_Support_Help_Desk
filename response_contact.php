<?php
// Specify the JSON file where contact data is stored
$file = 'contact_us.json';

// Check if the file exists and is readable
if (file_exists($file)) {
    // Read the JSON file and decode its contents into a PHP array
    $jsonData = file_get_contents($file);
    $contactRequests = json_decode($jsonData, true);
} else {
    // If the file does not exist, initialize an empty array
    $contactRequests = [];
}

// Handle form submission for responses
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'])) {
    $response = htmlspecialchars($_POST['response']);
    $requestIndex = intval($_POST['request_index']);
    
    // Here you can save the response to a file, send an email, etc.
    // For this example, we'll just print a success message.
    echo "<script>alert('Response submitted successfully!');</script>";

    // Optionally, you might want to append the response to the contact request.
    // $contactRequests[$requestIndex]['response'] = $response; // Save response to the request

    // You can also save the updated requests back to the JSON file if desired.
    // file_put_contents($file, json_encode($contactRequests, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Contact Requests</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0; /* Remove default margin */
        }

        /* Styling for the sidebar */
        .sidebar {
            width: 200px; /* Width of the sidebar */
            height: 100vh; /* Full viewport height */
            background-color: lightgrey; /* Light background */
            color: #ADD8E6; /* Text color */
            position: fixed; /* Keep it fixed to the left */
            top: 0; /* Stick to the top of the page */
            left: 0; /* Stick to the left side */
            padding: 20px; /* Inner padding for the sidebar content */
        }

        /* Styling for the heading in the sidebar */
        .sidebar h2 {
            margin-bottom: 20px; /* Space below the heading */
            font-size: 1.5rem; /* Set the heading font size */
            text-align: center; /* Center the heading */
            color: black;
        }

        /* Styling for the links inside the sidebar */
        .sidebar a {
            color: black; /* Black text for the links */
            text-decoration: none; /* Remove underlines from links */
            display: block; /* Make each link take up the full width */
            padding: 10px 0; /* Padding around the links */
            transition: background-color 0.3s ease; /* Smooth hover effect */
            text-align: center;
        }

        /* Hover effect for the links */
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Light background on hover */
        }

        /* Main content section */
        .main-content {
            margin-left: 220px; /* Push the main content to the right to make space for the sidebar */
            padding: 20px; /* Padding inside the main content area */
        }

        /* Content area styling */
        .content-area {
            margin-top: 20px; /* Space above content area */
            padding: 20px; /* Padding inside the content area */
            background-color: #f8f9fa; /* Light background for content area */
            border-radius: 5px; /* Rounded corners for content area */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Subtle shadow for content area */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto; /* Change height to auto for smaller screens */
                position: relative; /* Change position for smaller screens */
            }

            .main-content {
                margin-left: 0; /* Remove left margin on smaller screens */
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Sidebar</h2>
    <a href="ITSUPPORTEND.php">View User Requests</a>
    <a href="Contact_info.php">Queries from Users</a>
    <a href="Respond.php">Respond to Users</a>
</div>

<div class="main-content">
    <h1 style="text-align:center;">Respond to Contact Requests</h1>
    <div class="content-area">
        <?php if (empty($contactRequests)): ?>
            <div class="alert alert-warning" role="alert">
                No contact requests have been submitted yet.
            </div>
        <?php else: ?>
            <?php foreach ($contactRequests as $index => $request): ?>
                <div class="request-card" style="margin-bottom: 20px; padding: 15px; border: 1px solid #007BFF; border-radius: 5px; background-color: #fff;">
                    <h5><strong>Name:</strong> <?php echo htmlspecialchars($request['name']); ?></h5>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($request['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($request['phone']); ?></p>
                    <p><strong>Complaint:</strong> <?php echo htmlspecialchars($request['complaint']); ?></p>
                    <p><strong>Submitted on:</strong> <?php echo htmlspecialchars($request['timestamp']); ?></p>
                    
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="response">Your Response:</label>
                            <textarea class="form-control" id="response" name="response" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="request_index" value="<?php echo $index; ?>">
                        <button type="submit" class="btn btn-primary">Submit Response</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
