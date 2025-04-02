<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serpent's Ascent</title>
    <link rel="stylesheet" href="index.css">
</head>
<button><a href="logout.php">Logout</a></button>
<header>
    <h1>Welcome back <?php echo $_SESSION["username"] ?> to Serprent's Ascent</h1>
    <h2>Select your difficulty:</h1>
</header>
<body>
    <div class="easy">
        <a href="easygame.php"><h3>Easy</h3></a>
    </div>
    <div class="hard">
        <a href="hardgame.php"><h3>Hard</h3></a>
    </div>
    <div class="rules">
        <h4>Rules</h4>
            <li>Setup: Each player chooses a game piece and places it on the "Start" space (square 1). Players take turns rolling the die to determine the number of spaces they move. If the player selects the easy game then it will go to 50 points but hard game will go to 100 points.</li>
            <li>Turn Order: Players will select a button that will roll a die and move their piece forward the number of spaces indicated.</li>
            <li>Climbing Ladders: If a player lands exactly on a space with the bottom of a ladder, they move up to the space at the top of the ladder.</li>
            <li>Sliding Down Chutes: If a player lands exactly on a space with the top of a chute, they slide down to the space at the bottom of the chute.</li>
            <li>Exact Finish Required: A player must spin the exact number needed to land on the final space to win. If they spin a higher number, they do not move and must try again on their next turn.</li>
            <li>No Backward Movement: Players cannot move backward unless they slide down a chute.</li>
    </div>
</body>
</html>