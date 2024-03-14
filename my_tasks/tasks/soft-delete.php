<?php
    include '../includes/basic.php';
    $id = $_GET["tid"];
    $action = $_GET["action"];
    if($action == "delete"){
        $sql = "UPDATE tasks SET active = 2 WHERE id = $id";
        $location = "list.php";
    } elseif($action == "restore"){
        $sql = "UPDATE tasks SET active = 1 WHERE id = $id";
        $location = "trash.php";
    } elseif($action == "delete_forever"){
        $sql = "DELETE FROM tasks WHERE id = $id";
        $location = "trash.php";
    }

    mysqli_query($connection, $sql);
    
    header("Location: ../tasks/" . $location);
    
    
?>