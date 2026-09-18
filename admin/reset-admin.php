<?php
/** @var mysqli $conn */
include "../database/database.php";

$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "UPDATE admin SET password = ? WHERE username = 'admin'";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $password);
mysqli_stmt_execute($stmt);

echo "Admin password reset successfully.";

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>