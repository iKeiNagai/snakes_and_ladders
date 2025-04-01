<?php
$file = "users.txt";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        //read file to check if user exists
        if (file_exists($file)) {
            $users = file($file, FILE_IGNORE_NEW_LINES); //read file into an array
            
            //goes through all users
            foreach ($users as $user) {
                $userData = explode(",", $user); //split each user data into array
                
                //check if username and password are same
                if (strcasecmp($userData[0], $username) == 0 && $userData[3] === $password) {
                    session_start();
                    $_SESSION['username'] = $username;
                    $msg = "<span style='color:red;'>insert redirect inside this if!</span>";
                    break;
                }
            }

            if (empty($msg)) {
                $msg = "<span style='color:red;'>Invalid username or password!</span>";
            }
        }
    } else {
        $msg = "<span style='color:red;'>Please fill in all fields.</span>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <header>
        <h3>Welcome Back</h3>
    </header>

    <main>
        <form action="" method="POST">

            <label for="username">Username: </label>
            <input type="text" name="username"><br>

            <label for="password">Password: </label>
            <input type="password" name="password"><br>

            <input type="submit" value="Login">
            <?php echo $msg; ?>
        </form>
    </main>

    <footer>
        <p>Dont have an account?<a href="signup.php">Signup</a></p>
    </footer>

    <!-- remove this -->
    <?php 
        echo "Session variables <br>";
        if (session_status() == PHP_SESSION_ACTIVE) {
            echo "<pre>";
            print_r($_SESSION);
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo "No active session.";
        }
    ?>
</body>
</html>