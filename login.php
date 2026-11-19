
<?php
session_start();
require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT * FROM users
         WHERE email = ? AND status = 'active'"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify(
        $password, $user["password"]
    )) {

        session_regenerate_id(true);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["full_name"] = $user["full_name"];
        $_SESSION["role"] = $user["role"];

        header("Location: index.php");
        exit();

    } else {
        $error = "Incorrect email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>GlassMart Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-container">

    <h2>GLASSMART</h2>
    <h3>Welcome Back</h3>

    <?php if ($error): ?>
        <p style="color:red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password"
               name="password" required>

        <button type="submit">Sign In</button>

    </form>

    <p>New customer?
        <a href="register.php">Register here</a>
    </p>

</div>

</body>
</html>
