<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <!-- Add the Bootstrap CSS file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <!-- Add the Bootstrap JavaScript file -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body style="background-color:#D3D3D3;">
  <header>
    <?php include "nav.php" ?>
  </header>
  <main>
    <div class="container" >
      <div class="justify-content-center">
      <h2>Enter Project Details</h2>
        <form method="post" action="create.php" class="form">
          <div class="mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="requirements">Requirements:</label>
            <textarea class="form-control" name="requirements" id="requirements" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="software">Select required software:</label>
            <input type="text" name="software" class="form-control" id="software" required>
            <select class="form-control" name="softwareSelect" id="softwareSelect">
              <option val="default" disabled selected>Chose option</option>
              <?php
                  foreach ($software as $key => $value) {
                      echo "<option>$value</option>";
                  }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="hardware">Select required hardware:</label>
            <input type="text" name="hardware" class="form-control" id="hardware" required>
            <select class="form-control" name="hardwareSelect" id="hardwareSelect">
              <option val="default" disabled selected>Chose option</option>
              <?php
                  foreach ($hardware as $key => $value) {
                      echo "<option>$value</option>";
                  }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="semester">Select semester:</label>
            <select class="form-control" name="semester" id="semester" required>
              <option val="default" disabled selected>Chose option</option>
              <option val="fall">Fall</option>
              <option val="spring">Spring</option>
            </select>
          </div>
          <?php
              if($_SESSION["user_role"] == "admin"){
                  echo '<div class="form-group">
                          <a href="#">Add Files +</a>
                  </div>';
              }
          ?>
          <div class="row ms-auto">
            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-primary ml-auto">Submit Project</button>
                <a href="list.php" class="btn btn-danger ml-auto">Cancel</a>
            </div>
        </div>
      </form>
    </div>
  </div>
</main>
</body>

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