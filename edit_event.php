<?php
// Include database connection
require_once 'db_connect.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $_POST['title'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    
    // Simple validation
    if (empty($title) || empty($event_date) || empty($location)) {
        $error = "Please fill all required fields";
    } else {
        // Update event in database
        $sql = "UPDATE events SET 
                title = '$title', 
                event_date = '$event_date', 
                location = '$location', 
                description = '$description' 
                WHERE id = $id";
        
        if (mysqli_query($conn, $sql)) {
            // Redirect to index page
            header("Location: index.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}

// Get event data
$sql = "SELECT * FROM events WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$event = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-edit"></i> Edit Event</h1>
        
        <?php if (isset($error)): ?>
            <div class="error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <div class="form-group">
                <label for="title"><i class="fas fa-heading"></i> Event Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="event_date"><i class="fas fa-calendar-alt"></i> Event Date:</label>
                <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="location"><i class="fas fa-map-marker-alt"></i> Location:</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Description:</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($event['description']); ?></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Update Event
                </button>
                <a href="index.php" class="btn cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
