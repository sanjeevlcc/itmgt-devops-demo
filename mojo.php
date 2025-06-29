
<?php
session_start();

$wordList = ["apple", "banana", "grapes", "mango", "peach", "orange", "melon"];

if (!isset($_SESSION['word'])) {
    $_SESSION['word'] = $wordList[array_rand($wordList)];
    $_SESSION['guessed'] = [];
    $_SESSION['wrong'] = 0;
}

$word = $_SESSION['word'];
$guessed = $_SESSION['guessed'];
$wrong = $_SESSION['wrong'];
$maxTries = 6;

if (isset($_POST['letter'])) {
    $letter = strtolower($_POST['letter']);
    if (!in_array($letter, $guessed)) {
        $guessed[] = $letter;
        $_SESSION['guessed'] = $guessed;
        if (strpos($word, $letter) === false) {
            $wrong++;
            $_SESSION['wrong'] = $wrong;
        }
    }
}

function displayWord($word, $guessed) {
    $display = '';
    for ($i = 0; $i < strlen($word); $i++) {
        $display .= in_array($word[$i], $guessed) ? $word[$i] . ' ' : '_ ';
    }
    return $display;
}

function isWon($word, $guessed) {
    foreach (str_split($word) as $char) {
        if (!in_array($char, $guessed)) return false;
    }
    return true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hangman - mojo.php</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 50px; }
        input[type="text"] { width: 30px; text-align: center; }
        .hangman { font-size: 18px; letter-spacing: 10px; }
        .status { margin: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>🎯 Hangman Game (PHP Mojo)</h1>
    <div class="hangman"><?= displayWord($word, $guessed); ?></div>

    <?php if ($wrong >= $maxTries): ?>
        <div class="status" style="color: red;">😢 You lost! The word was: <strong><?= $word ?></strong></div>
        <form method="post"><button type="submit" name="reset">Play Again</button></form>
        <?php session_destroy(); ?>
    <?php elseif (isWon($word, $guessed)): ?>
        <div class="status" style="color: green;">🎉 You won! The word was: <strong><?= $word ?></strong></div>
        <form method="post"><button type="submit" name="reset">Play Again</button></form>
        <?php session_destroy(); ?>
    <?php else: ?>
        <form method="post">
            <input type="text" name="letter" maxlength="1" required autofocus>
            <button type="submit">Guess</button>
        </form>
        <div class="status">Wrong guesses: <?= $wrong ?>/<?= $maxTries ?></div>
        <div>Guessed letters: <?= implode(", ", $guessed); ?></div>
        <?php if (isset($_POST['reset'])) session_destroy(); ?>
    <?php endif; ?>
</body>
</html>
