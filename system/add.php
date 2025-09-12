<?php
session_start();
if (!$_SESSION['user']) {
    header("location:login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "users");

if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $details = $_POST['details'];
    $name = $_POST['name'];
    $public = isset($_POST['public']) ? 1 : 0;
    // $date_posted = date("Y-m-d");
    $post_time = date("H:i:s");
    $insert = mysqli_query($conn, "INSERT INTO list(name,details,post_time,public_post) VALUES('$name','$details','$post_time','$public')");
    if ($insert) {
        echo "<script>
                alert('Item added');
                window.location.href='home.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Item added');
                window.location.href='home.php';
              </script>";
        exit();
    }

}
?>