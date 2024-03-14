<?php include '../includes/basic.php'; ?>
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
        <h1 class="display-2 my-5 text-primary">New Task</h1>
        <div class="row">
            <form class="row" action="../tasks/save.php" method="post" enctype="multipart/form-data">
                <div class="col-12">
                    <label for="image">Profile Picture</label>
                    <input type="file" name="image" id="image" class="form-control mt-2 mb-3">
                </div>
                <div class="col-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control mt-2 mb-3">
                </div>
                <div class="col-12">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control mt-2 mb-3">
                </div>
                <div class="col-12">
                    <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control mt-2 mb-3">
                </div>
                <div class="col-6">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-select mt-2 mb-3">
                        <?php
                        $sql = "SELECT * FROM categories";
                        $categories_list = mysqli_query($connection, $sql);
                        while ($category = mysqli_fetch_assoc($categories_list)) {
                        ?>
                            <option value="<?php echo $category["id"]; ?>">
                                <?php echo $category["name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-6">
                    <label for="status_id">Status</label>
                    <select name="status_id" id="status_id" class="form-select mt-2 mb-3">
                        <?php
                        $sql = "SELECT * FROM statuses";
                        $statuses_list = mysqli_query($connection, $sql);
                        while ($status = mysqli_fetch_assoc($statuses_list)) {
                        ?>
                            <option value="<?php echo $status["id"]; ?>">
                                <?php echo $status["name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="assignees">Assignees 
                        <span style="font-size: 0.6em; color:red;">
                            (Use CTRL to select Multiple Assignees)
                        </span>
                    </label>
                    <select multiple name="assignees[]" id="assignees" class="form-select mt-2 mb-3">
                        <?php
                        $sql = "SELECT * FROM users";
                        $users_list = mysqli_query($connection, $sql);
                        while ($user = mysqli_fetch_assoc($users_list)) {
                        ?>
                            <option value="<?php echo $user["id"]; ?>">
                                <?php echo $user["name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-secondary" href="../tasks/list.php">Back to List</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>