<?php

require "db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $full_name = trim($_POST["full_name"] ?? "");
  $email = trim($_POST["email"] ?? "");
}
