<?php 
include '../includes/basic.php'; 
if(isset($_GET["search"])){
    $sr = $_GET["search"];
    $sql = "SELECT tasks.id, tasks.name AS taskname, tasks.due_date, tasks.date, categories.name AS categoryname, users.name AS username FROM tasks, categories, users WHERE categories.id = tasks.category_id AND users.id = tasks.user_id AND tasks.active = 1 AND tasks.name LIKE '%$sr%'";
} else {
    $sql = "SELECT tasks.id, tasks.name AS taskname, tasks.due_date, tasks.date, categories.name AS categoryname, users.name AS username FROM tasks, categories, users WHERE categories.id = tasks.category_id AND users.id = tasks.user_id AND tasks.active = 1";
}
$tasks_list = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Tasks - <?php echo $app_name; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <?php include '../includes/menubar.php'; ?>
    <div class="container">
        <h1 class="display-2 my-5 text-primary">Search Tasks</h1>
        <div class="row">
            <table class="table table-bordered">
                <tr class="table-dark text-center">
                    <th>Name</th>
                    <th>Due Date</th>
                    <th>Category</th>
                    <th>Created at</th>
                    <th>Created By</th>
                    <th>#</th>
                </tr>
                <?php while($task = mysqli_fetch_assoc($tasks_list)) { ?>
                <tr>
                    <td><?php echo $task["taskname"]; ?></td>
                    <td><?php echo $task["due_date"]; ?></td>
                    <td><?php echo $task["categoryname"]; ?></td>
                    <td><?php echo $task["date"]; ?></td>
                    <td><?php echo $task["username"]; ?></td>
                    <td class="text-center">
                        <a href="../tasks/show.php?tid=<?php echo $task["id"]; ?>" class="btn btn-secondary">Show</a>
                        <a href="../tasks/edit.php?tid=<?php echo $task["id"]; ?>" class="btn btn-primary">Edit</a>
                        <a href="../tasks/soft-delete.php?tid=<?php echo $task["id"]; ?>&action=delete" class="btn btn-danger">Delete</a>
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