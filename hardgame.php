<?php
session_start();

if (!isset($_SESSION['player_pos'])) $_SESSION['player_pos'] = 0;

$ladder_snake = [
    1 => 38, 4 => 14, 8 => 30, 6 => 36, 10 => 32,
    28 => 48, 21 => 42, 24 => 88, 50 => 67, 56 => 95,
    71 => 92, 78 => 97, 88 => 99
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dice_roll = rand(1, 6);
    $_SESSION['player_pos'] += $dice_roll;
    
    if ($_SESSION['player_pos'] > 100) {
        $_SESSION['player_pos'] -= $dice_roll;
    }
    
    if (isset($ladder_snake[$_SESSION['player_pos']])) {
        $_SESSION['player_pos'] = $ladder_snake[$_SESSION['player_pos']];
    }
    
    if ($_SESSION['player_pos'] == 100) {
        $winner = "Congratulations! You won!";
        session_destroy();
    }
}

function get_position($pos) {
    if ($pos == 0) return ['left' => 0, 'top' => 450];
    $row = (int)(($pos - 1) / 10);
    $col = ($pos - 1) % 10;
    if ($row % 2 != 0) {
        $col = 9 - $col;
    }
    return ['left' => $col * 50, 'top' => (9 - $row) * 50];
}

$player_pos = get_position($_SESSION['player_pos']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hard Snakes & Ladders</title>
    <style>
        .game-container {
            position: relative;
            width: 500px;
            height: 500px;
            background: url('board100.jpg') no-repeat center center;
            background-size: cover;
            border: 2px solid black;
        }
        .player {
            width: 30px;
            height: 30px;
            position: absolute;
            border-radius: 50%;
            background-color: red;
            color: white;
            text-align: center;
            line-height: 30px;
            font-size: 18px;
            font-weight: bold;
            transition: left 0.5s ease-in-out, top 0.5s ease-in-out;
        }

    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0;
        font-family: sans-serif;
        flex-direction: column;
    }

.center {
    text-align: center;
}
    </style>
    <button><a href="logout.php">Logout</a></button>
</head>
<body>
    <div class="center">
        <h2>Snakes & Ladders </h2>
        <?php if (isset($winner)) : ?>
            <h3><?php echo $winner; ?></h3>
            <a href="">Restart Game</a>
        <?php else : ?>
            <p>Player Position: <?php echo $_SESSION['player_pos']; ?></p>
            <form method="post">
                <button type="submit">Roll Dice</button>
            </form>
        <?php endif; ?>
        <div class="game-container">
            <div class="player" style="left: <?= $player_pos['left'] ?>px; top: <?= $player_pos['top'] ?>px;">P</div>
        </div>
    </div>
</body>
</html>
