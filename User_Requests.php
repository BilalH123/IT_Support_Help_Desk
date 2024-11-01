<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Helpdesk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light gray background */
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #007bff; /* Bootstrap's primary color */
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 30px 15px;
            z-index: 1000;
            align-items: center;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            text-align: center;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .sidebar a {
            color: #e9ecef;
            font-weight: 500;
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #0056b3;
            color: #ffffff;
        }

        /* Main content area */
        .main-content {
            margin-left: 270px; /* Adjusted for sidebar */
            padding: 40px 20px;
            min-height: 100vh;
        }

        /* Table styling */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>IT Helpdesk</h2>
        <a href="User_Requests.php">View Your Requests</a>
        <a href="User_Send_Request.html">Send a Request</a>
        <a href="User_Responses.php">Response</a>
    </div>

    <!-- Main content area -->
    <div class="main-content">
        <h1 class="text-center">User Requests</h1>
        <p class="text-center mb-5">This is the homepage for your requests. The IT support specialist will be able to view your ticket request.</p>

        <div class="content-area">
            <?php
            $file = 'data.json';

            // Check if the file exists and contains data
            if (file_exists($file)) {
                $jsonData = file_get_contents($file);
                $data = json_decode($jsonData, true); // Decode JSON data to PHP array

                // Display the data in a table or formatted way
                if (!empty($data)) {
                    echo "<table class='table table-striped table-hover'>";
                    echo "<thead>
                    <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Timestamp</th> <!-- Add timestamp column -->
                    </tr>
                    </thead>";
                    echo "<tbody>"; // Added tbody for better table structure
                    foreach ($data as $entry) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($entry['firstname']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['lastname']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['priority']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['timestamp']) . "</td>"; // Display timestamp
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-center'>No data available.</p>";
                }
            } else {
                echo "<p class='text-center'>No data available.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>




<!--strlen() returns length of a string in php
like if(strlen($data)>0)
isset() checks if a php function has been set and isnt null
