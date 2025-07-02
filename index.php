<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🏨 Makalu Hotel Booking</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
  <style>
    :root {
      --primary: #4a6bff;
      --secondary: #ff7e5f;
      --dark: #2d3748;
      --light: #f7fafc;
      --success: #48bb78;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
      color: var(--dark);
      min-height: 100vh;
      line-height: 1.6;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 2rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin-top: 3rem;
      margin-bottom: 3rem;
    }
    
    h1 {
      color: var(--primary);
      margin-bottom: 1.5rem;
      text-align: center;
      font-weight: 600;
    }
    
    .version {
      font-size: 0.9rem;
      color: #718096;
      text-align: center;
      margin-bottom: 2rem;
    }
    
    form {
      display: grid;
      gap: 1.2rem;
    }
    
    label {
      font-weight: 500;
      color: var(--dark);
    }
    
    input, select {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s;
    }
    
    input:focus, select:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(74, 107, 255, 0.2);
    }
    
    button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 1rem;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    button:hover {
      background: #3a56e0;
      transform: translateY(-2px);
    }
    
    footer {
      background: var(--dark);
      color: white;
      padding: 3rem 2rem;
      text-align: center;
    }
    
    .games-container {
      display: flex;
      justify-content: center;
      gap: 2rem;
      flex-wrap: wrap;
      margin-bottom: 2rem;
    }
    
    .game {
      background: rgba(255, 255, 255, 0.1);
      padding: 1.5rem;
      border-radius: 10px;
      width: 300px;
    }
    
    .game h3 {
      margin-bottom: 1rem;
      color: var(--secondary);
    }
    
    .game button {
      background: var(--secondary);
      margin-top: 1rem;
    }
    
    .game button:hover {
      background: #e66747;
    }
    
    .copyright {
      margin-top: 2rem;
      color: #a0aec0;
      font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
      .container {
        margin: 1rem;
        padding: 1.5rem;
      }
      
      .games-container {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">



    <h1> <div class="version">Issued ver 1.3.15  </div> </h1>




    
    <h1>🏨 Welcome to Makalu Hotel Booking</h1>
    
    <form action="submit.php" method="POST" onsubmit="return validateForm()">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required placeholder="John Doe">
      
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required placeholder="john@example.com">
      
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
    <div class="games-container">
      <div class="game" id="numberGame">
        <h3>🔢 Number Guessing Game</h3>
        <p>Guess a number between 1-100:</p>
        <input type="number" id="guessInput" min="1" max="100">
        <button onclick="checkGuess()">Submit Guess</button>
        <p id="numberResult"></p>
      </div>
      
      <div class="game" id="rpsGame">
        <h3>✊✋✌️ Rock Paper Scissors</h3>
        <p>Choose your move:</p>
        <div style="display: flex; gap: 10px; justify-content: center;">
          <button onclick="playGame('rock')">Rock</button>
          <button onclick="playGame('paper')">Paper</button>
          <button onclick="playGame('scissors')">Scissors</button>
        </div>
        <p id="rpsResult"></p>
      </div>
    </div>
    
    <div class="copyright">
      &copy; 2024 Makalu Hotel. All rights reserved.
    </div>
  </footer>
  
  <script>
    // Number Guessing Game
    const secretNumber = Math.floor(Math.random() * 100) + 1;
    let attempts = 0;
    
    function checkGuess() {
      const guess = parseInt(document.getElementById('guessInput').value);
      const resultElement = document.getElementById('numberResult');
      attempts++;
      
      if (isNaN(guess)) {
        resultElement.textContent = "Please enter a valid number!";
        return;
      }
      
      if (guess === secretNumber) {
        resultElement.textContent = `🎉 Correct! You guessed it in ${attempts} attempts.`;
        resultElement.style.color = "var(--success)";
      } else if (guess < secretNumber) {
        resultElement.textContent = "⬆️ Too low! Try again.";
        resultElement.style.color = "var(--secondary)";
      } else {
        resultElement.textContent = "⬇️ Too high! Try again.";
        resultElement.style.color = "var(--secondary)";
      }
    }
    
    // Rock Paper Scissors Game
    function playGame(playerChoice) {
      const choices = ['rock', 'paper', 'scissors'];
      const computerChoice = choices[Math.floor(Math.random() * 3)];
      const resultElement = document.getElementById('rpsResult');
      
      if (playerChoice === computerChoice) {
        resultElement.textContent = `🤝 Tie! Both chose ${playerChoice}.`;
        resultElement.style.color = "#f6ad55";
      } else if (
        (playerChoice === 'rock' && computerChoice === 'scissors') ||
        (playerChoice === 'paper' && computerChoice === 'rock') ||
        (playerChoice === 'scissors' && computerChoice === 'paper')
      ) {
        resultElement.textContent = `🎉 You win! ${playerChoice} beats ${computerChoice}.`;
        resultElement.style.color = "var(--success)";
      } else {
        resultElement.textContent = `😢 You lose! ${computerChoice} beats ${playerChoice}.`;
        resultElement.style.color = "var(--secondary)";
      }
    }
    
    // Form validation (placeholder)
    function validateForm() {
      // Add your validation logic here
      return true;
    }
  </script>
</body>
</html>
