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
            margin: 0;
            background-color: #f8f9fa; /* Light background */
        }

        /* Sidebar styling */
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
        

        .sidebar h2 {
            margin-bottom: 20px; /* Space below heading */
            font-size: 1.5rem; /* Font size */
            text-align: center; /* Center the heading */
            color: #ADD8E6; /* Light color for the heading */
        }

        .sidebar a {
            color: #fff; /* White text */
            text-decoration: none; /* Remove underline */
            display: block; /* Block display */
            padding: 10px; /* Padding around links */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth hover effect */
            margin-bottom: 10px; /* Space between links */
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Light background on hover */
        }

        /* Main content styling */
        .main-content {
            margin-left: 270px; /* Push main content right */
            padding: 20px; /* Padding for main content */
        }

        .content-area {
            margin: auto; /* Center content area */
            padding: 20px; /* Padding inside content area */
            background-color: #fff; /* White background for content area */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            max-width: 800px; /* Max width for content area */
        }

        /* Table styles */
        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* Collapse borders */
        }

        th, td {
            padding: 12px; /* Increased padding */
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
        <h1 style="display:flex; justify-content:center; align-items:center;">User Requests</h1> <!-- Centered heading -->
        <div class="content-area">
            <p class="text-center">This is the pending requests from users.</p>

            <?php
            $file = 'data.json';

            // Check if the file exists and contains data
            if (file_exists($file)) {
                $jsonData = file_get_contents($file);
                $data = json_decode($jsonData, true); // Decode JSON data to PHP array

                // Display the data in a table or formatted way
                if (!empty($data)) {
                    echo "<table class='table table-striped'>"; // Use Bootstrap table classes
                    echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Description</th><th>Priority</th><th>Timestamp</th></tr></thead>";
                    echo "<tbody>"; // Added tbody for better table structure
                    foreach ($data as $entry) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($entry['firstname']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['lastname']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['priority']) . "</td>";
                        echo "<td>" . (isset($entry['timestamp']) ? htmlspecialchars($entry['timestamp']) : "N/A") . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>No data available.</p>";
                }
            } else {
                echo "<p>No data available.</p>";
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
