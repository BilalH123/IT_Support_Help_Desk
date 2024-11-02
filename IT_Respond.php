<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Helpdesk</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling of classes */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-align: center;
            color: #ADD8E6;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
        }

        .content-area {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-radius: 0;
                box-shadow: none;
            }

            .main-content {
                margin-left: 0;
                padding: 10px;
            }

            .main-content h1 {
                text-align: center;
            }
        }
    </style>
</head>

<body>  
    <div class="sidebar"> /* Creates a sidebar */
        <h2>IT Support Helpdesk</h2>
        <a href="IT_User_Requests.php">View User Requests</a>
        <a href="IT_Respond.php">Respond to Users</a>
    </div>

    <div class="main-content">
        <h1 style="display:flex; justify-content:center; align-items:center;">Respond</h1>
        <div class="content-area">
            <p class="text-center">Respond to user requests by using the text box and button.</p>

            <?php 
                $file = 'data.json';
                $jsonData = file_get_contents($file);
                $requests = json_decode($jsonData, true);

                if ($requests && count($requests) > 0) {
                    echo '<table class="table table-striped">';
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>
