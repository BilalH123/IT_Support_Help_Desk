<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Helpdesk</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Styling/IT_STYLING.css">
<body>
    <!-- This creates the Sidebar -->
    <div class="sidebar">
        <h2>IT Support Helpdesk</h2>
        <a href="IT_User_Requests.php">View User Requests</a>
        <a href="IT_Respond.php">Respond to Users</a>
    </div>

    <!-- Main content area -->
    <div class="main-content">
        <h1 style="display:flex; justify-content:center; align-items:center;">User Requests</h1> 
        <div class="content-area">
            <p class="text-center">This is the pending requests from users.</p>

            <?php
            $file = '../Data/data.json';

            // This Checks if the file exists and contains data
            if (file_exists($file)) {
                $jsonData = file_get_contents($file);
                $data = json_decode($jsonData, true); // This Decodes JSON data to PHP array

                // This displays the data in a table or formatted way if it is not empty.
                if (!empty($data)) {
                    echo "<table class='table table-striped'>"; // This uses Bootstrap table classes
                    echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Description</th><th>Priority</th><th>Timestamp</th></tr></thead>";
                    echo "<tbody>"; 
                    foreach ($data as $entry) { // This actually creates the table and will show the table data sent by the user.
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
