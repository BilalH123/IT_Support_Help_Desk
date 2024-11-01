<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Helpdesk</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0; /* Remove default margin */
            background-color: #f8f9fa; /* Light background */
        }

        .sidebar {
            width: 250px; /* Width of the sidebar */
            height: 100vh; /* Full height */
            background-color: #343a40; /* Dark background */
            color: #fff; /* White text */
            position: fixed; /* Fixed position */
            top: 0; /* Stick to the top */
            left: 0; /* Stick to the left */
            padding: 20px;
            overflow-y: auto; /* Enable scrolling if content overflows */
        }

        /* Sidebar heading styling */
        .sidebar h2 {
            margin-bottom: 20px; /* Space below heading */
            font-size: 1.5rem; /* Heading font size */
            text-align: center; /* Center the heading */
            color: #ADD8E6; /* Light color for the heading */
        }

        /* Sidebar link styling */
        .sidebar a {
            color: #fff; /* White text */
            text-decoration: none; /* Remove underline */
            display: block; /* Block display */
            padding: 10px; /* Padding around links */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth hover effect */
            margin-bottom: 10px; /* Space between links */
        }

        /* Hover effect for sidebar links */
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Light background on hover */
        }

        /* Main content styling */
        .main-content {
            margin-left: 270px; /* Space for the sidebar */
            padding: 20px; /* Padding for main content */
        }

        /* Content area styling */
        .content-area {
            margin-top: 20px; /* Space above content area */
            padding: 20px; /* Padding for content area */
            background-color: #fff; /* White background for content area */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            max-width: 800px; /* Max width for content area to match the other one */
            margin: 20px auto; /* Center the content area */
        }

        /* Table styling */
        table {
            width: 100%; /* Full width */
            margin: 20px 0; /* Space above and below the table */
            border-collapse: collapse; /* Collapse borders */
        }

        th, td {
            padding: 15px; /* Increased padding */
            text-align: left; /* Align text to the left */
        }

        th {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text */
        }

        td {
            background-color: #f8f9fa; /* Light background for table rows */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Full width for small screens */
                height: auto; /* Auto height */
                position: relative; /* Relative positioning */
                border-radius: 0; /* Remove rounded corners */
                box-shadow: none; /* Remove shadow */
            }

            .main-content {
                margin-left: 0; /* Remove left margin */
                padding: 10px; /* Padding for smaller screens */
            }

            .main-content h1 {
                text-align: center; /* Center the main heading */
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>IT Support Helpdesk</h2>
        <a href="IT_User_Requests.php">View User Requests</a>
        <a href="IT_Respond.php">Respond to Users</a>
    </div>

    <!-- Main content area -->
    <div class="main-content">
    <h1 style="display:flex; justify-content:center; align-items:center;">Respond</h1>
        <div class="content-area">
            <p class="text-center">Respond to user requests by using the text box and button.</p>

            <?php 
                // Load and decode the JSON data
                $file = 'data.json';
                $jsonData = file_get_contents($file);
                $requests = json_decode($jsonData, true); // Decode JSON into an associative array

                if ($requests && count($requests) > 0) {
                    echo '<table class="table table-striped">'; // Added Bootstrap table classes
                    echo '<thead><tr><th>First Name</th><th>Response</th></tr></thead>';
                    echo '<tbody>';

                    foreach ($requests as $request) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($request['firstname']) . '</td>';
                        echo '<td>
                                <form method="post" action="send_response.php">
                                    <input type="hidden" name="user_email" value="' . htmlspecialchars($request['email']) . '">
                                    <textarea name="response" class="form-control mb-2" placeholder="Type your response here" required rows="4"></textarea>
                                    <button type="submit" class="btn btn-primary">Send Response</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No pending requests found.</p>';
                }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>
