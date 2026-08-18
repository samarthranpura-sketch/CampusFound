<?php

/** @var mysqli $conn */
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../pages/login.php");
    exit();
}

$itemName = trim($_POST["item_name"]);
$category = trim($_POST["category"]);
$dateLost = trim($_POST["date_lost"]);
$location = trim($_POST["location"]);
$description = trim($_POST["description"]);
$contactNumber = trim($_POST["contact_number"]);

include "../database/database.php";

$imagePath = "";
if (isset($_FILES["item_image"]) && $_FILES["item_image"]["error"] === 0) {
    $imageName = time() . "_" . basename($_FILES["item_image"]["name"]);
    $targetPath = "../images/lost/" . $imageName;
    move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetPath);
    $imagePath = "images/lost/" . $imageName;
}

$userId = $_SESSION["user_id"];
$sql = "INSERT INTO lost_items
(user_id, item_name, category, date_lost, location, description, contact_number, image)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "isssssss",
    $user_id,
    $item_name,
    $category,
    $date_lost,
    $location,
    $description,
    $contact_number,
    $imagePath
);

mysqli_stmt_execute($stmt);

echo "Lost item reported successfully!";
