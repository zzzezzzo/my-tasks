<?php
include '../includes/basic.php';
$name = $_POST['name'];
$desc = $_POST['description'];
$due  = $_POST['due_date'];
$cat  = $_POST['category_id'];
$id   = $_POST['id'];

$sql = "UPDATE tasks SET name = '$name', description = '$desc', due_date = '$due', category_id = $cat WHERE id = $id";

mysqli_query($connection, $sql);
header("Location: ../tasks/list.php");
?>