<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Helpdesk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Styling/USER_STYLING.css">
</head>

<body>
    <!-- This is the Sidebar -->
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
            $file = '../Data/data.json';

            // This checks if the file exists and contains data
            if (file_exists($file)) {
                $jsonData = file_get_contents($file);
                $data = json_decode($jsonData, true); // It decodes JSON data to PHP array

                // This displays the data in a table or formatted way if the form/data is not empty.
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
                    echo "<tbody>"; 
                    foreach ($data as $entry) { //The code below creates the table filled by the data the user sent.
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($entry['firstname']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['lastname']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['priority']) . "</td>";
                        echo "<td>" . htmlspecialchars($entry['timestamp']) . "</td>"; // Shows timestamp of submission
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


