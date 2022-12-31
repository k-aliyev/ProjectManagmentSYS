<?php

    require "./data.php";
    require "./db.php";
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(!$_SESSION["loggedin"]){
            header("Location: login.php");
        }
        $stmt = $db->prepare("SELECT * FROM user WHERE id = ?") ;
        $stmt->execute([$_SESSION["user_id"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(in_array($_SESSION["user_role"], $roles)){
            $stmt = $db->prepare("SELECT * FROM project JOIN members on members.project_id = project.id WHERE members.user_id = ?");
            $stmt->execute([$_SESSION["user_id"]]);
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if($_SESSION["user_role"] == 'instructor'){
            $stmt = $db->prepare("SELECT * FROM project WHERE advisor_id = ?");
            $stmt->execute([$_SESSION["user_id"]]);
            $ad_projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if($_SESSION["user_role"] == 'firm'){
            $stmt = $db->prepare("SELECT * FROM address WHERE user_id = ?");
            $stmt->execute([$_SESSION["user_id"]]);
            $address = $stmt->fetch(PDO::FETCH_ASSOC);
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
  <!-- Add the Bootstrap CSS file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <!-- Add the Bootstrap JavaScript file -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script>
    <?php 
        if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin"){
            include "admin_js.php";
        }
     ?>    
  </script>

  <style>
    tbody {
    display: block;
    max-height: 200px;
    overflow: auto;
    }
    thead, tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed
    }
  </style>
</head>
<body style="background-color:#D3D3D3;">
  <header> <?php include "nav.php"; ?> </header>
  <main>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="data:image/png;base64,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" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo ucwords($user["name"]) ?></h5>
            <p class="text-muted mb-1"><?php echo strtoupper($user["role"]) ?></p>
            <div class="d-flex justify-content-center mb-2">
              <a class="btn btn-primary" href="user_edit.php">Edit</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo ucwords($user["name"]) ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $user["email"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $user["username"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo strtoupper($user["role"]) ?></p>
              </div>
            </div>
            <hr>
            <div class="row" <?php if($user["role"] != 'firm'){echo "style='display:none;'";} ?>>
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo "{$address["address"]}, {$address["district"]}, {$address["city"]}" ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row" <?php if(!in_array($_SESSION["user_role"], $roles)){ echo "style='display:none;'"; }?>>
        <div class="col-md-<?php if(!isset($ad_projects)){ echo '14';}else{ echo '6';}?>">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4">My Project Status</p>
                    <?php
                        foreach ($projects as $key => $item) {
                            echo "<div class='mb-1 d-flex align-items-center justify-content-between'>";
                            echo "<a href='view.php?id={$item["id"]}' class='mb-0 font-weight-bold small'>{$item["name"]}</a>";
                            echo "<div class='w-80'></div>";
                            switch($item["status"]){
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
                            echo "</div>";
                        }
                    
                    ?>

              </div>
            </div>
          </div>

          <div class="col-md-6" <?php if(!isset($ad_projects)){ echo "style='display:none;'"; }?>>
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4">Assigned Project Status</p>
                <?php
                        foreach ($ad_projects as $key => $item) {
                            echo "<div class='mb-1 d-flex align-items-center justify-content-between'>";
                            echo "<a href='view.php?id={$item["id"]}' class='mb-0 font-weight-bold small'>{$item["name"]}</a>";
                            echo "<div class='w-80'></div>";
                            switch($item["status"]){
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
                            echo "</div>";
                        }
                    
                    ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</main>