<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "user";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_SESSION['user_id'])) {
        header("Location: php/profile.php");
    }

    if(isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $user_id = $user['id'];
            $_SESSION['user_id'] = $user_id;
            header("Location: php/profile.php");
        } else {
            echo "Invalid email or password";
        }
    }
?>