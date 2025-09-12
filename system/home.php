<?php
session_start();
if ($_SESSION['user']) {

} else {
    header("location:login.php");
}
$user = $_SESSION['user'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My List</title>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
</head>

<body>
    <button><a href="logout.php">logout</a></button>
    <h3 style="text-align: center;">My List</h3>
    <div>
        <h3>Add Items</h3>
        <form action="add.php" method="POST"
            style="border: solid; border-color: gray; width:20%; padding: 15px; display: flex; flex-direction: column;">
            <label>Name:</label>
            <input type="text" name="name">
            <br>
            <label>Details:</label>
            <input type="text" name="details">
            <br>
            <div style="display: flex; gap: 5px;">
                <input type="checkbox" name="public">
                <label>public post</label>

            </div>

            <br>
            <button type="submit" style="width: 30%;">add item</button>
        </form>

    </div>
    <div class="flex flex-row items-center justify-center"
        style="display:flex; flex-direction: row;  margin-top: 15px;">
        <table border="1px" width="65%">
            <tr>
                <td>Name</td>
                <td>Details</td>
                <td>Post Time</td>
                <td>Edit Time</td>
                <td>Edit</td>
                <td>Delete</td>
                <td>public Post</td>


            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "users");
            if ($conn->connect_error) {
                die("Connection Failed" . $conn->connect_error);
            }
            $querry = mysqli_query($conn, "SELECT * FROM list");
            if (mysqli_num_rows($querry) <= 0) {
                echo "<p>No data found</p>";
            } else {
                while ($row = mysqli_fetch_assoc($querry)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['details'] . "</td>";
                    echo "<td>" . $row['post_time'] . "</td>";
                    echo "<td>" . $row['edit_time'] . "</td>";
                    echo "<td><a href='edit.php?id=" . $row['ID'] . "'>edit</a></td>";
                    echo "<td><a href='delete.php'>delete</a></td>";
                    echo "<td>" . ($row['public_post'] ? 'yes' : 'no') . "</td>";
                    echo "</tr>";





                }

            }
            ?>
        </table>
    </div>
</body>

</html>