
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

function requireRole($roles) {

    if (!in_array($_SESSION["role"], $roles, true)) {
        http_response_code(403);
        exit("Access denied.");
    }
}
?>
