<?php
require "./data.php";
require "./db.php";
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Get the form data
    $name = $_POST["name"];

    // Validate the form data
    $errors = [];
    if(empty($name)){
        $errors[] = "Project name is required";
    }

    // If there are no errors, insert the user into the database
    if(empty($errors)){
        $stmt = $db->query("SELECT count(*) from project");
        $id = $stmt->fetchColumn();

        echo $id;

        $sql = "INSERT INTO project(id, name, description, requirements, software, hardware, status, year, semester, advisor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id + 1, $name, $_POST["description"], $_POST["requirements"],$_POST["software"],$_POST["hardware"],"waiting",date("Y"), $_POST["semester"], -1]);

        $sql = "INSERT INTO members(user_id, project_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_SESSION["user_id"], $id + 1]);
        header("Location: related_projects.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">All Projects</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="#">My Projects</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Log out</a>
              </li>
            </ul>
        </nav>
      </div>
    </header>
    <main>
      <div class="container">
        <div class="justify-content-center">
          <form method="post" action="edit.php">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" name="name" class="form-control" id="name" require>
            </div>
            <div class="form-group">
              <label for="description">Description:</label>
              <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="requirements">Requirements:</label>
              <textarea class="form-control" name="requirements" id="requirements" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="software">Select required software:</label>
              <input type="text" name="software" class="form-control" id="software" require>
              <select class="form-control" name="softwareSelect" id="softwareSelect">
                <option val="default" disabled selected>Chose option</option>
                <?php
                    foreach ($software as $key => $value) {
                        echo "<option>$value</option>";
                    }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="hardware">Select required hardware:</label>
              <input type="text" name="hardware" class="form-control" id="hardware" require>
              <select class="form-control" name="hardwareSelect" id="hardwareSelect">
                <option val="default" disabled selected>Chose option</option>
                <?php
                    foreach ($hardware as $key => $value) {
                        echo "<option>$value</option>";
                    }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="semester">Select semester:</label>
              <select class="form-control" name="semester" id="semester">
                <option val="default" disabled selected>Chose option</option>
                <option val="fall">Fall</option>
                <option val="spring">Spring</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Submit Project</button>
          </form>
        </div>
      </div>
    </main>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    $("#softwareSelect").on("change", function() {
      var optionSelected = $("option:selected", this);
      $("#software").val($("#software").val() + optionSelected.val() + ";");
      optionSelected.remove();
      $("#softwareSelect").val("default");
    });
    $("#hardwareSelect").on("change", function() {
      var optionSelected = $("option:selected", this);
      $("#hardware").val($("#hardware").val() + optionSelected.val() + ";");
      optionSelected.remove();
      $("#hardwareSelect").val("default");
    });
  </script>
</html>