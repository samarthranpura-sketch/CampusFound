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


/*IMAGE UPLOAD */

$imagePath = null;

if (isset($_FILES["item_image"]) && $_FILES["item_image"]["error"] === 0) {

    $uploadDir = "../images/found/";

    // Create folder if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["item_image"]["name"]);

    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetFile)) {
        $imagePath = "images/found/" . $fileName;
    }
}


/*----INSERT INTO DATABASE---*/

$sql = "INSERT INTO found_items
        (user_id, item_name, category, date_found, location, description, contact_number, image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "isssssss",
    $userId,
    $itemName,
    $category,
    $dateFound,
    $location,
    $description,
    $contactNumber,
    $imagePath
);

mysqli_stmt_execute($stmt);

header("Location: ../pages/report-found.php?success=1");
exit();
