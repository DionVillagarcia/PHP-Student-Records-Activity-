<?php

require "db.php";

//  {#1ea,2}
$stmt = $pdo->query("SELECT * FROM students");

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Records</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
</head>

<body class="content-container">
  <div class="table-container">
    <h1>Student Records</h1>
    <div>
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
              <a href="edit.php?id=<?php echo $student["id"]; ?>">
                Edit
              </a>
              |
              <form method="POST" action="delete.php" style="display:inline;"
                onsubmit="return confirm('Are you sure you want to delete this student?');">

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($student["id"]); ?>">

                <button type="submit" class="delete-button">
                  Delete
                </button>

              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div><a href="create.php"><button class="add-student-button">Add Student</button></a></div>
  </div>

</body>

</html>