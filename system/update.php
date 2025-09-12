<?php
session_start();
if(!$_SESSION['user']){
    header("Location:login.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conn=new mysqli("localhost","root","","users");
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $details=mysqli_real_escape_string($conn,$_POST['details']);
    $public_post=isset($_POST['public_post'])?1:0;
    $edit_time=date("H:i:s");
    $query=mysqli_query($conn,"UPDATE list SET name='$name', details='$details', public_post='$public_post', edit_time='$edit_time' WHERE ID='$id'"
);
if ($query) {
    echo "<script>
        alert('Edited successfully');
        window.location.href='home.php';
    </script>";
}

    else{
        echo"<script>alert('not success')</script>";
    }
    



}





?>