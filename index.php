<?php
// Include database connection
require_once 'db_connect.php';

// Get all events
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>🎉 Event Planner 🎉</h1>
        
        <!-- Button group -->
        <div class="button-group">
            <a href="add_event.php" class="btn">
                <i class="fas fa-plus"></i> Add New Event
            </a>
            <a href="view_events.php" class="btn">
                <i class="fas fa-eye"></i> View Events
            </a>
        </div>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td>
                                <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this event?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-events">No events found. <i class="fas fa-arrow-right"></i> Add one now!</p>
        <?php endif; ?>
    </div>
</body>
</html>
