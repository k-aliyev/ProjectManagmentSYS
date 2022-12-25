<?php
require "./db.php";
require "./data.php";
session_start();

//r stands for related
//a stands for all
if(isset($_GET["type"]) && !isset($_SESSION["loggedin"])){
  header("Location: not_authorized.php");
}
if(isset($_GET["type"]) && $_GET["type"]="r"){
    
    $sql= "SELECT * FROM project JOIN members on project.id = members.project_id WHERE members.user_id = ?";
    $stmt = $db->prepare($sql) ;
    $stmt->execute([$_SESSION["user_id"]]);
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    $stmt = $db->query("select * from project");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>My Page</title>
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
          <?php include "nav.php"; ?>
  </header>
  <main>
    <div class="container">
      <h2>List of Elements</h2>
      <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Submit Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($projects as $key => $value) {
              echo " <tr>
                        <th scope='col'>{$value["id"]}</th>
                        <th scope='col'>{$value["name"]}</th>
                        <th scope='col'>{$value["year"]} {$value["semester"]}</th>";

               echo "<th scope='col'>";
               switch($value["status"]){
                case "waiting":
                  echo "<button type='button' class='btn btn-warning' disabled>Waiting</button>";
                  break;
                case "accepted":
                  echo "<button type='button' class='btn btn-success' disabled>Accepted</button>";
                  break;
                case "rejected":
                  echo "<button type='button' class='btn btn-danger' disabled>Rejected</button>";
                  break;   
                }   
                echo "</th>";  

              if(isset($_GET["type"]) && $_GET["type"]="r"){
                if(in_array($_SESSION["user_role"], $roles)){
                  echo "<th scope='col'>
                        <a href='edit.php?id={$value["id"]}'>edit</a>
                        <a href='delete.php?id={$value["id"]}'>delete</a>
                      </th>";
                }
              }
              else{
                echo "<th scope='col'>
                        <a href='view.php?id={$value["id"]}'>view</a>
                      </th>";
              } 
              echo "</tr>";
            }


            if(isset($_GET["type"]) && $_GET["type"]="r"){
              echo "<tr><td colspan='4'><a href='create.php'>Create new project + </a><td></tr>";
          }
        ?>
      </tbody>
    </div>
  </main>
</body>
</html>