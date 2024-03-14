<?php
include '../includes/basic.php';
if(isset($_POST["email"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $users_set = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($users_set);

    if(isset($user["email"])){
        if($password == $user["password"]){
            header("Location: ../tasks/list.php");
        } else {
            $error_pass = "This Password is incorrect";
        }
    } else {
        $error = "This Email doesn't match our records";
    }
}
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
    <div class="container">
        <h1 class="display-2 my-5 text-primary">Login to Your account</h1>
        <div class="row">
            <form action="../auth/sign-in.php" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" class="form-control mt-2 mb-4">
                    <?php if(isset($error)) { ?>
                    <p class="alert alert-danger"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control mt-2 mb-4">
                    <?php if(isset($error_pass)) { ?>
                    <p class="alert alert-danger"><?php echo $error_pass; ?></p>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-outline-primary my-4">Sign in</button>
                <p class="text-center">Don't have an account? <a href="../auth/register.php">Create one</a></p>
            </form>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>