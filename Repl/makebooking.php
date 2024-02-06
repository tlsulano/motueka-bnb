<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Make a Booking</title>
</head>
<body>
    <br>
    <h1 class="MainTitle">Make a Booking:</h1>
    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form">
      <fieldset>
        <legend class="subhead">Booking form</legend>
        <br>

        <label for="room">Room (name, type, beds):</label>
        <select id="room" name="room">
          <?php
          // Assuming you have an array $rooms obtained from a database or another source
          // foreach ($rooms as $room) {
          //     echo "<option value='{$room['id']}'>{$room['name']}, {$room['type']}, {$room['beds']}</option>";
          // }
          // Placeholder option below as an example
          echo "<option value='kellie_5_5'>Kellie 5, 5</option>";
          ?>
        </select>
        <br>
        <br>

        <label for="checkin-date">Check-in date:</label>
        <input type="date" id="checkin-date" name="checkin-date">
        <br>
        <br>

        <label for="checkout-date">Checkout date:</label>
        <input type="date" id="checkout-date" name="checkout-date">
        <br>
        <br>

        <label for="contact-number">Contact number:</label>
        <input type="tel" id="contact-number" name="contact-number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890">

        <label for="booking-extras">Booking extras:</label>
        <input type="text" id="booking-extras" name="booking-extras">

        <br>
        <br>
        <input type="submit" value="Add">
        <input type="button" value="Cancel" onclick="window.location.href='Index.php';">
      </fieldset>
    </form>

    <div class="Lists">
        <a href="currentbookings.php" class="space">Return to Current Booking</a>
        <a href="index.php" class="space">Return to Main Page</a>
    </div>

</body>
</html>
