<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Helpdesk</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Styling/IT_Styling.css">
</head>
<body>
    <div class="sidebar">
        <h2>IT Support Helpdesk</h2>
        <a href="IT_User_Requests.php">View User Requests</a>
        <a href="IT_Respond.php">Respond to Users</a>
    </div>

    <div class="main-content">
        <h1 style="display:flex; justify-content:center; align-items:center;">Respond</h1>
        <div class="content-area">
            <p class="text-center">Respond to user requests by using the text box and button.</p>

            <?php
                $file = '../Forms/data.json'; // The file where requests are stored
                $jsonData = file_get_contents($file);
                $requests = json_decode($jsonData, true);

                if ($requests && count($requests) > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th>First Name</th><th>Response</th></tr></thead>';
                    echo '<tbody>';

                    foreach ($requests as $request) {
                        echo '<tr id="request-' . htmlspecialchars($request['email']) . '">';
                        echo '<td>' . htmlspecialchars($request['firstname']) . '</td>';
                        echo '<td>
                                <form id="response-form-' . htmlspecialchars($request['email']) . '" onsubmit="sendResponse(event, \'' . htmlspecialchars($request['email']) . '\')">
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
    <script>
        function sendResponse(event, email) {
            event.preventDefault();
            const form = event.target;
            const responseText = form.querySelector('textarea[name="response"]').value;

            $.ajax({
                url: '../Forms/Send_Response.php',
                type: 'POST',
                dataType: 'json', 
                data: {
                    user_email: email,
                    response: responseText
                },
                success: function(response) {
                    if (response.success) {
                        // Permanently remove the row after a successful submission
                        document.getElementById(`request-${email}`).remove();
                    } else {
                        alert('Failed to send response. ' + (response.error || 'Please try again.'));
                    }
                },
                error: function() {
                    alert('Error occurred. Please try again.');
                }
            });
        }
    </script>
</body>
</html>
