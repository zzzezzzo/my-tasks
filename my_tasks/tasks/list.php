<?php 
include '../includes/basic.php'; 
$sql = "SELECT tasks.id, tasks.image, tasks.name AS taskname, tasks.due_date, tasks.date, categories.name AS categoryname, users.name AS username FROM tasks, categories, users WHERE categories.id = tasks.category_id AND users.id = tasks.user_id AND tasks.active = 1";
$tasks_list = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks List - <?php echo $app_name; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <?php include '../includes/menubar.php'; ?>
    <div class="container">
        <h1 class="display-2 my-5 text-primary">Tasks List</h1>
        <div class="row">
            <table class="table table-bordered">
                <tr class="table-dark text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Due Date</th>
                    <th>Category</th>
                    <th>Created at</th>
                    <th>Created By</th>
                    <th>Status</th>
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
                    <?php
                    $task_id = $task["id"];
                    $sql = "SELECT * FROM status_task WHERE task_id = $task_id ORDER BY date DESC LIMIT 1";
                    $task_status_set = mysqli_query($connection, $sql);
                    $task_status_rec = mysqli_fetch_assoc($task_status_set);
                    $task_status = $task_status_rec["status_id"];
                    if($task_status == 1) {
                        echo '<span data-task-id="' . $task_id .'" data-bs-toggle="modal" data-bs-target="#edit_task_status" class="status_symbol badge bg-info">To Do</span>';
                    } else if($task_status == 2) {
                        echo '<span data-task-id="' . $task_id . '" data-bs-toggle="modal" data-bs-target="#edit_task_status" class="status_symbol badge bg-warning">In Progress</span>';
                    } else if($task_status == 3) {
                        echo '<span data-task-id="' . $task_id . '" data-bs-toggle="modal" data-bs-target="#edit_task_status" class="status_symbol badge bg-success">Done</span>';
                    } else if($task_status == 4) {
                        echo '<span data-task-id="' . $task_id . '" data-bs-toggle="modal" data-bs-target="#edit_task_status" class="status_symbol badge bg-secondary">Postponed</span>';
                    } else if($task_status == 5) {
                        echo '<span data-task-id="' .$task_id . '" data-bs-toggle="modal" data-bs-target="#edit_task_status" class="status_symbol badge bg-danger">Canceled</span>';
                    }
                    ?>
                    </td>
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

    
    <!-- Modal -->
    <div class="modal fade" id="edit_task_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Task Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../tasks/update_status.php" method="post">
                <div class="modal-body">
                        <select name="s_id" id="s_id" class="form-select">
                            <option value="">Select the new Status of the Task</option>
                            <?php
                            $sql= "SELECT * FROM statuses";
                            $statuses_set = mysqli_query($connection, $sql);
                            while($status_rec = mysqli_fetch_assoc($statuses_set)) {
                            ?>
                                <option value="<?php echo $status_rec["id"]; ?>">
                                    <?php echo $status_rec["name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="t_id" id="t_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>