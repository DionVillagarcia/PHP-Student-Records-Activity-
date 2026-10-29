<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("Invalid request.");
}

$id = $_POST["id"] ?? null;

if (!$id) {
  die("Student ID is required.");
}

$stmt = $pdo->prepare(
  "DELETE FROM students WHERE id = :id"
);

$stmt->execute([
  ":id" => $id
]);

header("Location: index.php");
exit;
