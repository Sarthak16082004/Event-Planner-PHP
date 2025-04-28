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
    <style>
        /* Additional beautiful colorful styles */

        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            color: #2c3e50;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .btn {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn:hover {
            background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%);
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }

        .btn.edit {
            background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);
            color: black;
        }

        .btn.delete {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }

        .events-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 10px;
        }

        .events-table th {
            background-color: #00c6ff;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 18px;
        }

        .events-table td {
            padding: 12px;
            text-align: center;
            background-color: #f9f9f9;
            font-size: 16px;
        }

        .events-table tr:nth-child(even) {
            background-color: #e0f7fa;
        }

        .events-table tr:hover {
            background-color: #d1c4e9;
            transition: background-color 0.3s ease;
        }

        .no-events {
            text-align: center;
            margin-top: 50px;
            font-size: 20px;
            color: #555;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Event Planner 🎉</h1>
        
        <!-- Button group -->
        <div class="button-group">
            <a href="add_event.php" class="btn">➕ Add New Event</a>
            <a href="view_events.php" class="btn">👀 View Events</a>
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
                                <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn edit">✏️ Edit</a>
                                <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this event?')">🗑️ Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-events">No events found. ➡️ Add one now!</p>
        <?php endif; ?>
    </div>
</body>
</html>
