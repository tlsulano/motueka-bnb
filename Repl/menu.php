<div id="header">
  <div id="logo">
    <div id="logo_text">
      <!-- class="logo_colour", allows you to change the colour of the text -->
      <h1><a href="/bnb/"><span class="logo_colour">Motueka Bed & Breakfast</span></a></h1>
      <h2>Escape to The Motueka Bed & Breakfast, your cozy retreat by the east coast. Dream peacefully and wake up to warmth and charm that feels like home. Join us for an experience that's as restful as it is memorable. Welcome to where your comfort is our delight</h2>
    </div>
  </div>
  <div id="menubar">
    <ul id="menu">
      <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
        <?php
        // Define an associative array with page names as keys and URLs as values
        $navLinks = [
            'login' => '/login.php',
            'current_booking' => '/currentbookings.php',
            'make_booking' => '/makebooking.php',
            'edit_booking' => '/editbooking.php', // Placeholder URL, adjust as needed
            'delete_booking' => '/deletebooking.php', // Placeholder URL, adjust as needed
        ];

        // Determine the current page to set the 'selected' class on the correct nav item
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <div id="header">
            <div id="logo">
                <!-- Your logo and text here -->
            </div>
            <div id="menubar">
                <ul id="menu">
                    <?php foreach ($navLinks as $page => $url): ?>
                        <li <?php echo ($current_page == basename($url)) ? 'class="selected"' : ''; ?>>
                            <a href="<?php echo $url; ?>">
                                <?php echo ucwords(str_replace('_', ' ', $page)); // Replace underscores with spaces and capitalize words ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <!-- Add more list items here if needed -->
                </ul>
            </div>
        </div>
    </div>
    </div>
</div>
</div>