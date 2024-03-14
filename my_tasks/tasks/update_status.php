<?php
include '../includes/basic.php';

$status_id = $_POST["s_id"];
$task_id = $_POST["t_id"];
$user_id = 1;

$sql = "INSERT INTO status_task (task_id, status_id, user_id) VALUES ($task_id, $status_id, $user_id)";
mysqli_query($connection, $sql);
header("Location: ../tasks/list.php");
?>