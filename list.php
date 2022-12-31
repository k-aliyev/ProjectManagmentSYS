<?php
require "./db.php";
require "./data.php";
session_start();

//r stands for related
//a stands for all
if(isset($_GET["type"]) && !isset($_SESSION["loggedin"])){
  header("Location: login.php");
}
if(isset($_GET["type"]) && $_GET["type"]="r"){

  if($_SESSION["user_role"] == "instructor"){
    $sql= "SELECT * FROM project WHERE advisor_id = ?";
   }else{
    $sql= "SELECT * FROM project JOIN members on project.id = members.project_id WHERE members.user_id = ?";
   }
  
    $stmt = $db->prepare($sql) ;
    $stmt->execute([$_SESSION["user_id"]]);
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    $stmt = $db->query("select * from project");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $elements = array();
  $sql= "SELECT project.id, project.name, project.year, project.semester, project.status FROM project 
  JOIN members on project.id = members.project_id
  JOIN user on user.id = members.user_id WHERE ";
  if(isset($_POST["member_name"]) && $_POST["member_name"] != ""){
    $sql = $sql."user.name like ? ";
    $elements[] = "%{$_POST["member_name"]}%";
  }
  if(isset($_POST["project_name"]) && $_POST["project_name"] != ""){
    $sql = $sql."project.name like ? ";
    $elements[] = "%{$_POST["project_name"]}%";
  }
  if(isset($_POST["year"]) && $_POST["year"] != ""){
    $sql = $sql."project.year = ? ";
    $elements[] = $_POST["year"];
  }
  if(isset($_POST["semester"]) && $_POST["semester"] != 'default'){
    $sql = $sql."project.semester = ? ";
    $elements[] = $_POST["semester"];
  }
  if(count($elements) > 0){
    $stmt = $db->prepare($sql) ;
    $stmt->execute($elements);
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script><?php
   if(isset($_SESSION["user_role"]) && in_array($_SESSION["user_role"], $roles)){
    include "user_list_js.php";
   }
  ?></script>
</head>
  <body style="background-color:#D3D3D3;">
  <header>
          <?php include "nav.php"; ?>
  </header>
  <main>
  <div id="collapsible-element" class="collapse">
  <form method="post" action="list.php" class="form search-container">
      <div class="row">
          <div class="col-2">
            <input type="text" name="member_name" id="member_name" class="form-control" placeholder = "Student Name">
          </div>
          <div class="col-2">
            <input type="text" name="project_name" id="project_name" class="form-control" placeholder = "Project Name">
          </div>
          <div class="col-2">
            <input type="text" name="year" id="year" class="form-control" placeholder = "YYYY">
          </div>
          <div class="col-2">
            <select class="form-control" name="semester" id="semester">
              <option val="default" disabled selected>Chose option</option>
              <option val="fall">Fall</option>
              <option val="spring">Spring</option>
            </select>
          </div>
          <div class="col-2 justify-content-center" style="margin-left:auto;">
            <button type="submit" class="btn btn-primary">Search 🔎</button>
          </div>
      </div>
    </form>
    </div>
   <div style="margin-left:auto;">
      <button type="button" style="margin: 10px;" class="btn btn-secondary btn-circle btn-lg" data-bs-toggle="collapse" data-bs-target="#collapsible-element" aria-expanded="false" aria-controls="collapsible-element">
        <svg width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.99997 7V4C2.99997 3.44772 3.44769 3 3.99997 3H20.0001C20.5523 3 21 3.44766 21.0001 3.9999L21.0004 7M2.99997 7L9.65077 12.7007C9.87241 12.8907 9.99998 13.168 9.99998 13.4599V19.7192C9.99998 20.3698 10.6114 20.8472 11.2425 20.6894L13.2425 20.1894C13.6877 20.0781 14 19.6781 14 19.2192V13.46C14 13.168 14.1275 12.8907 14.3492 12.7007L21.0004 7M2.99997 7H21.0004" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button> 
   </div>

    </div>  
    <div class="container">
      <h2>List of Elements</h2>
      <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Year</th>
                <th scope="col">Semester</th>
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
                        <th scope='col'>{$value["year"]}</th>
                        <th scope='col'>{$value["semester"]}</th>";

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
                        <a data-bs-toggle='modal' onclick='prepareDelete(this)' data-id='{$value["id"]}' data-bs-target='#deleteModal' href='#'>delete</a>
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
              echo "<tr><td colspan='5'><a href='create.php'>Create new project + </a><td></tr>";
          }
        ?>
      </tbody>
    </div>
  </main>

  <?php
   if(isset($_SESSION["user_role"]) && in_array($_SESSION["user_role"], $roles)){
    echo "<div class='modal fade' id='deleteModal' tabindex='-1' aria-labelledby='deleteModal' aria-hidden='true'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteModal'>Delete Project</h5>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
          <div class='form-group'>
            <label for='deleteInput'>Are you sure?</label>
            <input type='text' class='form-control' id='deleteInput' aria-describedby='deleteHelp'>
            <small id='deleteHelp' class='form-text text-muted'>Write DELETE and press submit button to delete project</small>
          </div>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
          <button type='button' id='deleteBtn' disabled onclick='deleteProject()' class='btn btn-primary'>Submit</button>
        </div>
      </div>
    </div>
  </div>";
   }
  ?>

</body>
</html>