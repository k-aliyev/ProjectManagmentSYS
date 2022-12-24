<?php
require "./db.php";
session_start();

$sql= "SELECT * FROM project JOIN members on project.id = members.project_id WHERE members.user_id = ?";
$stmt = $db->prepare($sql) ;
$stmt->execute($_SESSION["user_id"]);
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo implode(",",$projects);

?>

<!DOCTYPE html>
<html>
<head>
  <title>My Page</title>
  <!-- Add the Bootstrap CSS file -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <header>
      <h1>Welcome, <?php echo $_SESSION["username"] ?></h1>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">All Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">My Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Log out</a>
            </li>
          </ul>
        </div>
      </nav>
  </header>
  <main>
    <div class="container">
      <h2>List of Elements</h2>
      <ul class="list-group">
        <?php
            foreach ($projects as $key => $value) {
                echo "<li class='list-group-item'>{$value["name"]}</li>";
            }
        ?>
        <li class="list-group-item">
            <a href="edit.php">Create new project +</a>
        </li>
      </ul>
    </div>
  </main>
</body>
  <!-- Add the Bootstrap JavaScript file -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>