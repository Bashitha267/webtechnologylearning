<?php
session_start();
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $conn = new mysqli("localhost", "root", "", "users");
    if ($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $querry = mysqli_query($conn, "SELECT * FROM user_details WHERE username='$username'");
    if (mysqli_num_rows($querry) <= 0) {
        $message = "User Doesnt Exists";

    } else {
        $row = mysqli_fetch_assoc($querry);
        $user = $row['username'];
        $pass = $row['password'];
        if ($pass === $password) {
            $_SESSION['user'] = $username;
            header("Location:home.php");
            exit();
        } else {
            $message = "Password invalid";


        }
    }






    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>


<body>
    <h3>Welcome Back </h3>
    <form action="login.php" method="POST"
        style="border: solid; border-color: gray; width:20%; padding: 15px; display: flex; flex-direction: column;">
        <label>Username:</label>
        <input type="text" required name="username">
        <br>
        <label>Password:</label>
        <input type="password" required name="password">

        <br>
        <button type="submit" style="width: fit-content; ">submit</button>
        <p style="color: red;"><?php echo $message ?></p>
    </form>
</body>

</html>