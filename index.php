<?php

require "db.php";

$stmt = $pdo->query("SELECT * FROM students");

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Student Records</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
    <?php foreach ($students as $student): ?>
      <tr>
        <td>
          <?php echo htmlspecialchars($student["id"]); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($student["full_name"]); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($student["email"]); ?>
        </td>
        <td>
          Edit
          Delete
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>