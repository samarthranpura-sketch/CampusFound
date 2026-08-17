<?php
/** @var mysqli $conn */
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../pages/login.php");
    exit();
}

$itemName = trim($_POST["item_name"]);
$category = trim($_POST["category"]);
$dateFound = $_POST["date_found"];
$location = trim($_POST["location"]);
$description = trim($_POST["description"]);
$contactNumber = trim($_POST["contact_number"]);

include "../database/database.php";

$userId = $_SESSION["user_id"];

$sql = "INSERT INTO found_items
        (user_id, item_name, category, date_found, location, description, contact_number)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "issssss",
    $userId,
    $itemName,
    $category,
    $dateFound,
    $location,
    $description,
    $contactNumber
);

mysqli_stmt_execute($stmt);

echo "Found item reported successfully!";