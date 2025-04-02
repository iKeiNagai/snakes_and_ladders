<?php
session_start();

if (!isset($_SESSION['player_pos'])) $_SESSION['player_pos'] = 0;

$ladder_snake = [
    1 => 38, 4 => 14, 8 => 30, 21 => 42, 28 => 76, 32 => 10, 36 => 6,
    48 => 26, 50 => 67, 62 => 18, 71 => 92, 80 => 99, 88 => 24,
    95 => 56, 97 => 78
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
    <title>Single-Player Snakes & Ladders</title>
    <link rel="stylesheet" href="game100.css">
</head>
<body>
    <h2>Snakes & Ladders - Single Player</h2>
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
</body>
</html>
