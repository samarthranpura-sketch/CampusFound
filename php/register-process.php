<?php

include "../database/database.php";

/** @var mysqli $conn */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        echo "Email already exists!";
    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertSql = "INSERT INTO users (fullname, email, password)
                  VALUES (?, ?, ?)";

        $insertStmt = mysqli_prepare($conn, $insertSql);

        mysqli_stmt_bind_param(
            $insertStmt,
            "sss",
            $fullname,
            $email,
            $hashedPassword
        );

        mysqli_stmt_execute($insertStmt);

        header("Location: ../pages/login.php");
        exit();
    }
}
