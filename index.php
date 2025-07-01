<?php
// Handle games logic
session_start();

// Number Guessing Game Logic
if (!isset($_SESSION['secret_number'])) {
    $_SESSION['secret_number'] = rand(1, 100);
    $_SESSION['attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guess'])) {
    $_SESSION['attempts']++;
    $user_guess = (int)$_POST['guess'];
    $secret_number = $_SESSION['secret_number'];
    
    if ($user_guess < $secret_number) {
        $guess_result = "Too low! Try a higher number.";
    } elseif ($user_guess > $secret_number) {
        $guess_result = "Too high! Try a lower number.";
    } else {
        $guess_result = "Congratulations! You guessed it in {$_SESSION['attempts']} tries.";
        unset($_SESSION['secret_number']);
    }
}

// Rock-Paper-Scissors Game Logic
$choices = ['rock', 'paper', 'scissors'];
$rps_result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rps_choice'])) {
    $player_choice = $_POST['rps_choice'];
    $computer_choice = $choices[array_rand($choices)];
    
    if ($player_choice === $computer_choice) {
        $rps_result = "It's a tie! Both chose $player_choice.";
    } elseif (
        ($player_choice === 'rock' && $computer_choice === 'scissors') ||
        ($player_choice === 'paper' && $computer_choice === 'rock') ||
        ($player_choice === 'scissors' && $computer_choice === 'paper')
    ) {
        $rps_result = "You win! $player_choice beats $computer_choice.";
    } else {
        $rps_result = "You lose! $computer_choice beats $player_choice.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Makalu Hotel Booking</title>
  <style>
    :root {
      --primary: #2c3e50;
      --secondary: #3498db;
      --accent: #e74c3c;
      --light: #ecf0f1;
      --dark: #2c3e50;
      --success: #2ecc71;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      background-color: #f5f7fa;
      color: var(--dark);
      line-height: 1.6;
    }
    
    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
      color: var(--primary);
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
      padding-bottom: 10px;
    }
    
    h1:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: var(--secondary);
    }
    
    .version {
      text-align: right;
      font-size: 0.8rem;
      color: #7f8c8d;
      margin-bottom: 1rem;
    }
    
    form {
      display: grid;
      grid-gap: 1rem;
    }
    
    label {
      font-weight: 600;
      color: var(--primary);
    }
    
    input, select {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
      transition: border 0.3s;
    }
    
    input:focus, select:focus {
      outline: none;
      border-color: var(--secondary);
      box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }
    
    button {
      background: var(--secondary);
      color: white;
      border: none;
      padding: 1rem;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }
    
    button:hover {
      background: #2980b9;
      transform: translateY(-2px);
    }
    
    footer {
      background: var(--primary);
      color: white;
      padding: 2rem;
      margin-top: 3rem;
    }
    
    .footer-content {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }
    
    .footer-section {
      margin-bottom: 1.5rem;
    }
    
    .footer-section h3 {
      color: var(--secondary);
      margin-bottom: 1rem;
      position: relative;
      padding-bottom: 5px;
    }
    
    .footer-section h3:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 2px;
      background: var(--accent);
    }
    
    .game-container {
      background: rgba(255, 255, 255, 0.1);
      padding: 1rem;
      border-radius: 5px;
      margin-top: 1rem;
    }
    
    .game-result {
      margin-top: 1rem;
      padding: 0.5rem;
      border-radius: 5px;
      background: rgba(255, 255, 255, 0.2);
    }
    
    .copyright {
      text-align: center;
      padding-top: 2rem;
      margin-top: 2rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 0.9rem;
      color: #bdc3c7;
    }
    
    @media (max-width: 768px) {
      .container {
        margin: 1rem;
        padding: 1.5rem;
      }
      
      .footer-content {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="version">Issued ver 1.3.11</div>
    
    <h1>🏨 Welcome to Makalu Hotel Booking</h1>
    <form action="submit.php" method="POST" onsubmit="return validateForm()">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required placeholder="Enter your full name">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required placeholder="Enter your email">

      <label for="checkin">Check-in Date</label>
      <input type="date" id="checkin" name="checkin" required>

      <label for="checkout">Check-out Date</label>
      <input type="date" id="checkout" name="checkout" required>

      <label for="room">Room Type</label>
      <select id="room" name="room">
        <option value="Single">Single Room ($99/night)</option>
        <option value="Double">Double Room ($149/night)</option>
        <option value="Deluxe">Deluxe Suite ($249/night)</option>
      </select>

      <button type="submit">Book Now</button>
    </form>
  </div>

  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>About Makalu Hotel</h3>
        <p>Experience luxury and comfort at our premier hotel. We offer world-class amenities and exceptional service to make your stay unforgettable.</p>
      </div>
      
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Rooms</a></li>
          <li><a href="#">Amenities</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      
      <div class="footer-section">
        <h3>Play Our Mini Games</h3>
        
        <div class="game-container">
          <h4>Number Guessing Game</h4>
          <p>Guess a number between 1-100</p>
          <form method="post">
            <input type="number" name="guess" min="1" max="100" required placeholder="Enter your guess">
            <button type="submit">Guess</button>
          </form>
          <?php if (isset($guess_result)): ?>
            <div class="game-result"><?= $guess_result ?></div>
          <?php endif; ?>
        </div>
        
        <div class="game-container" style="margin-top: 1.5rem;">
          <h4>Rock Paper Scissors</h4>
          <form method="post">
            <select name="rps_choice" style="margin-bottom: 0.5rem;">
              <option value="rock">Rock</option>
              <option value="paper">Paper</option>
              <option value="scissors">Scissors</option>
            </select>
            <button type="submit">Play</button>
          </form>
          <?php if (!empty($rps_result)): ?>
            <div class="game-result"><?= $rps_result ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <div class="copyright">
      &copy; <?= date('Y') ?> Makalu Hotel. All rights reserved. | Version 1.3.11
    </div>
  </footer>

  <script>
    function validateForm() {
      const checkin = document.getElementById('checkin').value;
      const checkout = document.getElementById('checkout').value;
      
      if (new Date(checkout) <= new Date(checkin)) {
        alert('Check-out date must be after check-in date');
        return false;
      }
      return true;
    }
    
    // Set min date for check-in to today
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('checkin').min = today;
      
      // Update checkout min date when checkin changes
      document.getElementById('checkin').addEventListener('change', function() {
        document.getElementById('checkout').min = this.value;
      });
    });
  </script>
</body>
</html>
