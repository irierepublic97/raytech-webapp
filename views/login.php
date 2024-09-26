<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raytech | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "../classes/database.php";


            $sql = "SELECT id, full_name, email, password FROM users WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $userId, $fullName, $userEmail, $hashedPassword);
                mysqli_stmt_fetch($stmt);


                if ($hashedPassword && password_verify($password, $hashedPassword)) {

                    $_SESSION["user"] = "yes";
                    $_SESSION["user_id"] = $userId;
                    $_SESSION["user_name"] = $fullName;
                    $_SESSION["user_email"] = $userEmail;
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Incorrect email or password.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error in login process. Please try again.</div>";
            }
        }
        ?>
        <center>
            <div class="logo-img">
                <img src="../assets/images/logo.jpg" alt="User Image" class="logo-img">
            </div>
            <br>
            <h3><b>RayTech Advanced Repair Services</b></h3>
            <h1><b>Login</b></h1>
            <br>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter Your Email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Your Password" name="password" class="form-control"
                        required>
                </div>
                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </div>
            </form>
            <br>
            <div>
                <p>Not registered yet? <a href="registration.php">Register Here</a></p>
            </div>
        </center>
    </div>
</body>

</html>