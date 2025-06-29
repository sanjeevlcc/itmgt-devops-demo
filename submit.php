<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $checkin  = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room     = $_POST['room'];

    echo "<h2>✅ Booking Confirmation</h2>";
    echo "Thank you, <strong>$name</strong>!<br>";
    echo "Email: $email<br>";
    echo "Check-in: $checkin<br>";
    echo "Check-out: $checkout<br>";
    echo "Room Type: $room<br>";
    echo "<p>We look forward to hosting you!!!!!</p>";

    
    echo "<hr>";
    echo "<p><a href='mojo.php?user=" . urlencode($name) . "'><button>🎮 Play Hangman Game, $name</button></a></p>";
  


    
} else {
    echo "❌ Invalid Request";
}
?>
