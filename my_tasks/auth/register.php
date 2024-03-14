<?php 
include '../includes/basic.php';
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"] == "" ? null : $_POST["phone"];
    $salary = $_POST["salary"] == "" ? null : $_POST["salary"];
    $city_id = $_POST["city_id"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $users_set = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($users_set);

    if(isset($user["email"])){
        $error = "This Email is already taken";
    } else {
        $sql = "INSERT INTO users (name, email, password, phone, salary, city_id) VALUES ('$name', '$email', '$password', '$phone', '$salary', $city_id)";
        mysqli_query($connection, $sql);
        header("Location: ../auth/sign-in.php");
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
        <h1 class="display-2 my-5 text-primary">Create a new account</h1>
        <div class="row">
            <form action="../auth/register.php" method="post">
                <div class="form-group">
                    <label for="name">Name 
                        <span class="required-field">(required)</span>
                    </label>
                    <input type="text" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" name="name" id="name" class="form-control mt-2 mb-4" placeholder="Type Your Full Name Here" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address 
                        <span class="required-field">(required)</span>
                    </label>
                    <input type="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" name="email" id="email" class="form-control mt-2 mb-4" placeholder="Type Your Unique Email Here" required>
                    <?php if(isset($error)) { ?>
                    <p class="alert alert-danger"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password">Password 
                        <span class="required-field">(required)</span>
                    </label>
                    <input type="password" name="password" id="password" class="form-control mt-2 mb-4" placeholder="Type a Strong Password Here" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>" name="phone" id="phone" class="form-control mt-2 mb-4" placeholder="Type Your Phone Number Here">
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="number" step="100" value="<?php echo isset($_POST["salary"]) ? $_POST["salary"] : ''; ?>" name="salary" id="salary" class="form-control mt-2 mb-4" placeholder="Type Your Basic Salary Here">
                </div>
                <div class="form-group">
                    <label for="city_id">City</label>
                    <select name="city_id" id="city_id" class="form-select mt-2 mb-4">
                        <?php
                        $sql = "SELECT * FROM cities";
                        $cities = mysqli_query($connection, $sql);
                        while ($city = mysqli_fetch_array($cities)) {
                        ?>
                        <option value="<?php echo $city["id"]; ?>">
                            <?php echo $city["name"]; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-primary my-4">Create account</button>
                <p class="text-center">Already have an account? 
                    <a href="../auth/sign-in.php">sign in</a>
                </p>
            </form>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>