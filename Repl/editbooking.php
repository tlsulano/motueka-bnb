<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Booking</title>
</head>
<body>

<?php
include "config.php"; // Load in any variables
include "cleaninput.php"; // Include your input cleaning function

$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; // Stop processing the page further
};

// Retrieve the bookingId from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $bookingId = isset($_GET['id']) ? cleanInput($_GET['id']) : null;
    if (empty($bookingId) or !is_numeric($bookingId)) {
        echo "<h2>Invalid Booking ID</h2>"; // Simple error feedback
        exit;
    }
}

if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update')) {
    $error = 0; // Clear our error flag
    $msg = 'Error: ';

    $bookingId = isset($_POST['id']) && is_numeric($_POST['id']) ? cleanInput($_POST['id']) : 0;
    $roomID = cleanInput($_POST['roomID']);
    $checkinDate = cleanInput($_POST['checkinDate']);
    $checkoutDate = cleanInput($_POST['checkoutDate']);

    if ($error == 0 and $bookingId > 0) {
        $query = "UPDATE booking SET roomID=?, checkinDate=?, checkoutDate=? WHERE bookingID=?";
        $stmt = mysqli_prepare($db_connection, $query);
        mysqli_stmt_bind_param($stmt, 'issi', $roomID, $checkinDate, $checkoutDate, $bookingId);
        if (mysqli_stmt_execute($stmt)) {
            echo "<h2>Booking details updated successfully.</h2>";
        } else {
            echo "<h2>Error updating booking details.</h2>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<h2>$msg</h2>";
    }
}

// Locate the booking to edit by using the bookingID
if (!empty($bookingId)) {
    $query = "SELECT bookingID, roomID, checkinDate, checkoutDate FROM booking WHERE bookingID=?";
    $stmt = mysqli_prepare($db_connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $bookingId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
?>
<h1>Edit Booking Details</h1>
<h2><a href='listbookings.php'>[Return to Booking Listing]</a> <a href='index.php'>[Return to Main Page]</a></h2>

<form method="POST" action="">
  <input type="hidden" name="id" value="<?php echo $bookingId; ?>">
  <p>
    <label for="roomID">Room ID:</label>
    <input type="number" id="roomID" name="roomID" required value="<?php echo $row['roomID']; ?>">
  </p>
  <p>
    <label for="checkinDate">Check-in Date:</label>
    <input type="date" id="checkinDate" name="checkinDate" required value="<?php echo $row['checkinDate']; ?>">
  </p>
  <p>
    <label for="checkoutDate">Check-out Date:</label>
    <input type="date" id="checkoutDate" name="checkoutDate" required value="<?php echo $row['checkoutDate']; ?>">
  </p>

  <input type="submit" name="submit" value="Update">
</form>
<?php
    } else {
        echo "<h2>Booking not found with that ID.</h2>"; // Simple error feedback
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($db_connection); // Close the connection once done
?>
</body>
</html>
