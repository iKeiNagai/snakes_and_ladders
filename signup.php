<?php
$file = "users.txt";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($gender)  && !empty($email) && !empty($password)) {
        //read file to check if user exists
        if (file_exists($file)) {
            $users = file($file, FILE_IGNORE_NEW_LINES); //read file into an array
            
            //goes through all users
            foreach ($users as $user) {
                $userData = explode(",", $user); //split each user data into array
                
                //check if user name is the same
                if (strcasecmp($userData[0], $username) == 0) {
                    $msg = "<span style='color:red;'>Username already exists!</span>";
                    break;
                }
            }

            if (empty($msg)) {
                $newUser = "$username,$gender,$email,$password\n";
                file_put_contents($file, $newUser, FILE_APPEND);

                $msg = "<span style='color:green;'> Signup successful!";
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
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    <header>
        <h3>Welcome to Serpent's Ascent</h3>
        <p>Create new account</p>
    </header>

    <main>
        <form action="" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username"><br>
            
            Gender:
            <label for="male">Male</label>
            <input type="radio" name="gender" value="M">

            <label for="female">Female</label>
            <input type="radio" name="gender" value="F"><br>

            <label for="email">Email: </label>
            <input type="email" name="email"><br>

            <label for="password">Password: </label>
            <input type="password" name="password"><br>

            <input type="submit" value="Register">
            <?php echo $msg; ?>
        </form>
    </main>

    <!-- remove -->
    <?php 
        $users = file_get_contents("users.txt");
        echo "<pre>" . $users;
    ?>

    <footer>
        <p>Already have an account?<a href="login.php">Login</a></p>
    </footer>
</body>
</html>