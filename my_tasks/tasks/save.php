<?php
include '../includes/basic.php';
$name = $_POST['name'];
$desc = $_POST['description'];
$due  = $_POST['due_date'];
$cat  = $_POST['category_id'];
$user_id = 1;
/**************File Upload *************/
$tmp = $_FILES["image"]["tmp_name"];
$location = "../img/tasks/";
$now = date("Y-m-d-h-i-s"); 
$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$filename = "task-" . $now . "." . $ext;
$new_path = $location . $filename;
move_uploaded_file($tmp, $new_path);
/**************File Upload *************/
$sql = "INSERT INTO tasks (image, name, due_date, description, user_id, category_id) VALUES ('$filename', '$name', '$due', '$desc', $user_id, $cat)";
mysqli_query($connection, $sql);

/******************* Assign Task to Users ********/ 
// ASC -> Ascending تصاعدي
// DESC -> Descending تنازلي
$sql = "SELECT id FROM tasks ORDER BY id DESC LIMIT 1";
$latest_task_set = mysqli_query($connection, $sql);
$latest_task = mysqli_fetch_assoc($latest_task_set);
$task = $latest_task["id"];

foreach($_POST["assignees"] AS $assignee){
    $sql = "INSERT INTO task_user(task_id, user_id) VALUES ($task, $assignee)";
    mysqli_query($connection, $sql);
}
/******************* Assign Task to Users ********/ 
/****************** Task Status ******************/
$status = $_POST["status_id"];
$status_date = date("Y-m-d h:i:s"); 
$sql = "INSERT INTO status_task (task_id, status_id, user_id, date) VALUES ($task, $status, $user_id, '$status_date')";
mysqli_query($connection, $sql);
/****************** Task Status ******************/
header("Location: ../tasks/list.php");

// echo $_FILES["image"]["name"];
// echo $_FILES["image"]["tmp_name"];
// echo $_FILES["image"]["size"];
// echo $_FILES["image"]["type"];
?>