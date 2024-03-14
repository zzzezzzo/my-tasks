<?php 
include '../includes/basic.php'; 
$id = $_GET["tid"];
$sql = "SELECT * FROM tasks WHERE id = $id";
$data = mysqli_query($connection, $sql);
$task = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $app_name; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <?php include '../includes/menubar.php'; ?>
    <div class="container">
        <h1 class="display-2 my-5 text-primary">Edit Task</h1>
        <div class="row">
            <form action="../tasks/update.php" method="post">
                <div class="col-12">
                    <label for="name">Name</label>
                    <input type="text" value="<?php echo $task["name"]; ?>" name="name" id="name" class="form-control mt-2 mb-3">
                </div>
                <div class="col-12">
                    <label for="description">Description</label>
                    <input type="text" value="<?php echo $task["description"]; ?>" name="description" id="description" class="form-control mt-2 mb-3">
                </div>
                <div class="col-12">
                    <label for="due_date">Due Date</label>
                    <input type="date" value="<?php echo $task["due_date"]; ?>" name="due_date" id="due_date" class="form-control mt-2 mb-3">
                </div>
                <div class="col-12">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control mt-2 mb-3">
                        <?php
                            $sql = "SELECT * FROM categories";
                            $categories = mysqli_query($connection, $sql);
                            while ($category = mysqli_fetch_assoc($categories)) {
                        ?>
                            <option <?php if($category["id"] == $task["category_id"]){ echo "selected"; } ?> value="<?php echo $category["id"]; ?>">
                                <?php echo $category["name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo $task["id"]; ?>">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-secondary" href="../tasks/list.php">Back to List</a>
            </form>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>