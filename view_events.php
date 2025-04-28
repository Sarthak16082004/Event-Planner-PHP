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
    <style>
        .event-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        
        .event-title {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .event-date, .event-location {
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        
        .event-description {
            margin-top: 10px;
            line-height: 1.5;
        }
        
        .search-box {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }
        
        .search-box input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .no-events {
            text-align: center;
            color: #7f8c8d;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Event Listings</h1>
        
        <!-- Search box -->
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="search-box">
            <input type="text" name="search" placeholder="Search events..." value="<?php echo htmlspecialchars($search_term); ?>">
            <button type="submit" class="btn">Search</button>
            <?php if (!empty($search_term)): ?>
                <a href="view_events.php" class="btn cancel">Clear</a>
            <?php endif; ?>
        </form>
        
        <!-- Display the events -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="events-container">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="event-card">
                        <h2 class="event-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                        <p class="event-date"><strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                        <p class="event-location"><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                        <?php if (!empty($row['description'])): ?>
                            <p class="event-description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-events">No events found. <?php echo !empty($search_term) ? 'Try a different search term.' : ''; ?></p>
        <?php endif; ?>
        
        <a href="index.php" class="back-link">← Back to all events</a>
    </div>
</body>
</html>