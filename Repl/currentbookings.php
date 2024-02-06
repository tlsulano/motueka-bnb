<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Current Booking</title>
</head>
<body>
    <h1 class="MainTitle">Current Bookings:</h1>

    <br>

    <table border="1" class="database">
        <thead>
            <tr>
                <th>Booking (room, dates)</th>
                <th>Customer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $pdo is a PDO object connected to a database
            // $bookings = $pdo->query('SELECT * FROM bookings');
            // while ($booking = $bookings->fetch()) {
            //     echo "<tr>";
            //     echo "<td>" . htmlspecialchars($booking['room']) . ", " . htmlspecialchars($booking['start_date']) . ", " . htmlspecialchars($booking['end_date']) . "</td>";
            //     echo "<td>" . htmlspecialchars($booking['customer']) . "</td>";
            //     echo '<td>
            //         <a href="editbooking.php?id=' . htmlspecialchars($booking['id']) . '" class="space">Edit Booking</a>|
            //         <a href="showbookingdetails.php?id=' . htmlspecialchars($booking['id']) . '" class="space">Show Booking details</a>|
            //         <a href="deletebooking.php?id=' . htmlspecialchars($booking['id']) . '" class="space" onclick="return confirm(\'Are you sure?\')">Delete Booking</a>
            //         </td>';
            //     echo "</tr>";
            // }
            ?>
        </tbody>
    </table>

    <div class="Lists">
        <a href="makebooking.php" class="space">Make a Booking</a>
        <a href="index.php" class="space">Return to Main Page</a>
    </div>
</body>
</html>
