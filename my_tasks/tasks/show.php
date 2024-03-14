<?php 
include '../includes/basic.php';
$id = $_GET["tid"];
$sql = "SELECT tasks.*, users.name as username, categories.name as categoryname FROM tasks , users, categories WHERE users.id = tasks.user_id AND categories.id = tasks.category_id AND tasks.id = $id";
$data = mysqli_query($connection, $sql);
$task = mysqli_fetch_assoc($data);

$task_id = $task["id"];
$sql = "SELECT task_user.*, users.name FROM task_user, users WHERE users.id = task_user.user_id AND task_id = $task_id";
$task_assignees_list = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Task Details - <?php echo $app_name; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <?php include '../includes/menubar.php'; ?>
    <div class="container">
        <h1 class="display-2 my-5 text-primary">Show Task Details</h1>
        <div class="row">
            <div class="col-8">
                <h4 class="mb-4">Task Name:        <?php echo $task["name"]; ?></h4>
                <h4 class="mb-4">Task Description: <?php echo $task["description"]; ?></h4>
                <h4 class="mb-4">Task Date:        <?php echo $task["date"]; ?></h4>
                <h4 class="mb-4">Task Due Date:    <?php echo $task["due_date"]; ?></h4>
                <h4 class="mb-4">Task Category:    <?php echo $task["categoryname"]; ?></h4>
                <h4 class="mb-4">Created By:       <?php echo $task["username"]; ?></h4>
            </div>
            <div class="col-4">
                <img id="task-show" src="../img/tasks/<?php echo $task["image"]; ?>">
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered table-dark mb-5 text-center">
                <tr>
                    <th>Assignee Name</th>
                    <th>Actions</th>
                </tr>
                <?php while($assignee = mysqli_fetch_assoc($task_assignees_list)) { ?>                
                <tr>
                    <td><?php echo $assignee["name"]; ?></td>
                    <td><a href="../tasks/remove_assignee.php" class="btn btn-danger">Remove</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>