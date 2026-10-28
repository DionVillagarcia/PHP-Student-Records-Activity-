<?php

$host = "localhost";
$dbname = "student_db";
$username = "root";
$password = "root";

try {

  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $username,
    $password
  );

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

  die("Database connection failed.");
}
