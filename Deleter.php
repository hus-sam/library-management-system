<?php
session_start();
include("library.php");


if (!isset($_GET['id'])) {
    header("location: Metaphor.php");
    exit();
}

$id = intval($_GET['id']);
$user_role = $_SESSION['role'];
$user_name = $_SESSION['sname'];


if ($user_role == 'admin') {
 
    $sql = "DELETE FROM `metaphor1` WHERE `mnumber` = $id";
} else {

    $sql = "DELETE FROM `metaphor1` WHERE `mnumber` = $id AND `msname` = '$user_name'";
}


if (mysqli_query($conn, $sql)) {

    header("location: Metaphor.php?status=success");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>