<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register </title>
</head>
<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "";

    $conn = new mysqli("localhost", "root", "", "users");
    $bool = true;
    if ($conn->connect_error) {
        die("Connection Error:" . $conn->connect_error);
    }
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $querry = mysqli_query($conn, "SELECT*FROM user_details where username='$username'");
    if (mysqli_num_rows($querry) > 0) {
        $bool = false;
        $message = "Username is already taken";


    } else {

        $insert = mysqli_query($conn, "INSERT INTO user_details(username,password) VALUE('$username','$password')");

        if ($insert) {
            $message = "Registration Success.";
            header("Location:login.php");
            exit();
        } else {
            $message = "Registration Failed";
        }

    }

    $conn->close();


}


?>

<body>
    <h3>Register New User</h3>
    <form action="register.php" method="POST"
        style="border: solid; border-color: gray; width: max-content; padding: 15px; display: flex; flex-direction: column;">
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