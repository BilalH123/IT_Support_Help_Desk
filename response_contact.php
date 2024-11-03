<?php
// The file where the json data will be stored
$file = 'contact_us.json';

// This checks if the file exists and is readable
if (file_exists($file)) {
    // This reads the JSON file and decode its contents into a PHP array
    $jsonData = file_get_contents($file);
    $contactRequests = json_decode($jsonData, true);
} else {
    // If the file does not exist, It initializes an empty array
    $contactRequests = [];
}

// This deals with the form submission and ensures it's been created correctly. isset checks if there is a response field in the form.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'])) {
    $response = htmlspecialchars($_POST['response']);
    $requestIndex = intval($_POST['request_index']);

    echo "<script>alert('Response submitted successfully!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Contact Requests</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Styling/IT_STYLING.css">

</head>
<body>
<!--Sidebar-->
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
        <?php else: ?>   <!--Creates a table containing the form submission data the user submitted-->
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
