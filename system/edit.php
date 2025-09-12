<?php
session_start();
if (!$_SESSION['user']) {
    header("location:login.php");
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$conn = new mysqli("localhost", "root", "", "users");
if ($conn->connect_error) {
    die("Connection Error" . $conn->connect_error);
}
$querry = mysqli_query($conn, "Select*from list where ID='$id'");
if (mysqli_num_rows($querry) <= 0) {
    die("No data found");
} else {
    $row = mysqli_fetch_assoc($querry);
    $name = $row['name'];
    $details = $row['details'];
    $public_post = $row['public_post'] ? "yes" : "no";
}
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <h3 style="text-align: center;">My List</h3>
    <div>
        <h3>Edit Item</h3>
        <form action="update.php?id=<?php echo $id?>" method="POST"
            style="border: solid; border-color: gray; width:20%; padding: 15px; display: flex; flex-direction: column;">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $name ?>">
            <br>
            <label>Details:</label>
            <input type="text" name="details" value="<?php echo $details ?>">
            <br>
            <div style="display: flex; gap: 5px;">
                <input type="checkbox" name="public_post" value="<?php echo $public_post ?>">
                <label>public post</label>

            </div>

            <br>
            <button type="submit" style="width: 30%;">edit item</button>
        </form>

        <script src="" async defer></script>
</body>

</html>