<?php

require "db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
  die("Student ID is required.");
}

$stmt = $pdo->prepare(
  "SELECT * FROM students WHERE id = :id"
);

$stmt->execute([
  ":id" => $id
]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
  die("Student not found.");
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $full_name = trim($_POST["full_name"] ?? "");
  $email = trim($_POST["email"] ?? "");

  if ($full_name === "") {
    $errors[] = "Full name is required.";
  }

  if ($email === "") {

    $errors[] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $errors[] = "Please enter a valid email address.";
  }

  if (empty($errors)) {

    $stmt = $pdo->prepare(
      "UPDATE students
             SET full_name = :full_name,
                 email = :email
             WHERE id = :id"
    );

    $stmt->execute([
      ":full_name" => $full_name,
      ":email" => $email,
      ":id" => $id
    ]);

    header("Location: index.php");
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Edit Student</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css">

</head>

<body class="content-container">
  <div class="table-container form-add-student">
    <h1 style="margin: 0 0 20px 0px;">Edit Student</h1>

    <?php if (!empty($errors)): ?>

      <ul>

        <?php foreach ($errors as $error): ?>

          <li>
            <?php echo htmlspecialchars($error); ?>
          </li>

        <?php endforeach; ?>

      </ul>

    <?php endif; ?>


    <form method="POST" class="add-student-form">

      <label>
        Full Name
      </label>

      <input type="text" name="full_name" value="<?php echo htmlspecialchars($student["full_name"]); ?>">

      <label>
        Email
      </label>

      <input type="email" name="email" value="<?php echo htmlspecialchars($student["email"]); ?>">

      <button type="submit" class="add-student-button1">
        Save Changes
      </button>

    </form>


    <br>

    <a href="index.php">
      Cancel
    </a>
  </div>
</body>

</html>