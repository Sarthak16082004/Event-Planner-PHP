<?php
// Include database connection
require_once 'db_connect.php';

// Check if search is submitted
$search_term = '';
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    // Create search query
    $sql = "SELECT * FROM events 
            WHERE title LIKE '%$search_term%' 
            OR location LIKE '%$search_term%' 
            OR description LIKE '%$search_term%'
            ORDER BY event_date ASC";
} else {
    // Default query to get all events
    $sql = "SELECT * FROM events ORDER BY event_date ASC";
}

// Execute the query
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Event Listings</h1>
        
        <!-- Search box -->
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="search-box">
            <input type="text" name="search" placeholder="Search events..." value="<?php echo htmlspecialchars($search_term); ?>">
            <button type="submit" class="btn">
                <i class="fas fa-search"></i> Search
            </button>
            <?php if (!empty($search_term)): ?>
                <a href="view_events.php" class="btn cancel">
                    <i class="fas fa-times"></i> Clear
                </a>
            <?php endif; ?>
        </form>
        
        <!-- Display the events -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="events-container">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="event-card">
                        <h2 class="event-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                        <p class="event-date">
                            <strong><i class="fas fa-calendar-alt"></i> Date:</strong> 
                            <?php echo htmlspecialchars($row['event_date']); ?>
                        </p>
                        <p class="event-location">
                            <strong><i class="fas fa-map-marker-alt"></i> Location:</strong> 
                            <?php echo htmlspecialchars($row['location']); ?>
                        </p>
                        <?php if (!empty($row['description'])): ?>
                            <p class="event-description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-events">
                No events found. 
                <?php echo !empty($search_term) ? 'Try a different search term.' : ''; ?>
            </p>
        <?php endif; ?>
        
        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to all events
        </a>
    </div>
</body>
</html>
