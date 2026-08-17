<?php

session_start();
include "../database/database.php";
/** @var mysqli $conn */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user["password"];

        if (password_verify($password, $hashedPassword)) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["fullname"] = $user["fullname"];

            header("Location: ../index.php");
            exit();
        } else {

            echo "Incorrect password!";
        }
    } else {

        echo "User not found!";
    }
}
