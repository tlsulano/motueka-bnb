<?php
include "config.php"; // Contains your database connection settings
include "cleaninput.php"; // Function to clean input to prevent SQL injection

$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve current rooms for the dropdown
function getRooms($db_connection) {
    $query = "SELECT roomID, roomname FROM room";
    $result = mysqli_query($db_connection, $query);
    if (!$result) {
        echo "Error fetching rooms: " . mysqli_error($db_connection);
        exit;
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to add a booking
function addBooking($db_connection, $roomID, $customerID, $checkinDate, $checkoutDate) {
    $query = "INSERT INTO booking (roomID, customerID, checkinDate, checkoutDate) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($db_connection, $query)) {
        mysqli_stmt_bind_param($stmt, "iiss", $roomID, $customerID, $checkinDate, $checkoutDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    } else {
        return false;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitBooking'])) {
    $roomID = cleanInput($_POST['room']);
    $customerID = cleanInput($_POST['customerID']); // You need to collect this from the form or context
    $checkinDate = cleanInput($_POST['checkin-date']);
    $checkoutDate = cleanInput($_POST['checkout-date']);

    // Assuming you have validation and sanitization functions
    // Add further validation here as required

    $success = addBooking($db_connection, $roomID, $customerID, $checkinDate, $checkoutDate);
    if ($success) {
        echo "<p>Booking successful!</p>";
    } else {
        echo "<p>Error adding booking.</p>";
    }
}

$rooms = getRooms($db_connection);
mysqli_close($db_connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Booking</title>
    <!-- Include jQuery for AJAX requests and the date picker -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
    $(function() {
        $("#checkin-date, #checkout-date").datepicker({ dateFormat: 'yy-mm-dd' });

        // Add the AJAX request handler here
    });
    </script>
</head>
<body>
    <h1>Make a Booking</h1>
    <form method="post" action="makebooking.php">
        <label for="room">Room:</label>
        <select id="room" name="room">
            <?php foreach($rooms as $room): ?>
                <option value="<?php echo htmlspecialchars($room['roomID']); ?>">
                    <?php echo htmlspecialchars($room['roomname']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <!-- Add fields for customer ID, check-in and check-out dates -->
        <input type="submit" name="submitBooking" value="Make Booking">
    </form>

    <!-- Include other form elements for searching room availability -->
    <!-- ... -->
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
