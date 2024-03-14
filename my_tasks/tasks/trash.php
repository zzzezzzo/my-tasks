<?php 
include '../includes/basic.php'; 
$sql = "SELECT tasks.id, tasks.image, tasks.name AS taskname, tasks.due_date, tasks.date, categories.name AS categoryname, users.name AS username FROM tasks, categories, users WHERE categories.id = tasks.category_id AND users.id = tasks.user_id AND tasks.active = 2";
$tasks_list = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Trash - <?php echo $app_name; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <?php include '../includes/menubar.php'; ?>
    <div class="container">
        <h1 class="display-2 my-5 text-danger">
            <img style="height: 100px;" src="../css/icons/trash.svg"> 
            Tasks Trash
        </h1>
        <div class="row">
            <table class="table table-bordered">
                <tr class="table-dark text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Due Date</th>
                    <th>Category</th>
                    <th>Created at</th>
                    <th>Created By</th>
                    <th>#</th>
                </tr>
                <?php while($task = mysqli_fetch_assoc($tasks_list)) { ?>
                <tr>
                    <td><img class="task-img" src="../img/tasks/<?php echo $task["image"]; ?>"></td>
                    <td><?php echo $task["taskname"]; ?></td>
                    <td><?php echo $task["due_date"]; ?></td>
                    <td><?php echo $task["categoryname"]; ?></td>
                    <td><?php echo $task["date"]; ?></td>
                    <td><?php echo $task["username"]; ?></td>
                    <td class="text-center">
                        <a href="../tasks/soft-delete.php?tid=<?php echo $task["id"]; ?>&action=restore" class="btn btn-success">Restore</a>
                        <a href="../tasks/soft-delete.php?tid=<?php echo $task["id"]; ?>&action=delete_forever" class="btn btn-danger">Delete Permanently</a>
                    </td>
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