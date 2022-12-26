<?php
require "./data.php";
require "./db.php";
session_start();

if(isset($_GET["id"])){
    $stmt = $db->prepare("select * from project where id = ?");
    $stmt->execute([$_GET["id"]]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if($project == false){
        header("Location: not_found.php");
    }else{
        $stmt = $db->prepare("select * from user where id = ? and role= 'instructor'");
        $stmt->execute([$project["advisor_id"]]);
        $instructor = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT * FROM user JOIN members on user.id = members.user_id WHERE members.project_id = ?");
        $stmt->execute([$_GET["id"]]);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'admin'){
        $stmt = $db->prepare("select * from user where role= 'instructor' and id != ?");
        $stmt->execute([$project["advisor_id"]]);
        $appoint_instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT * FROM user WHERE id not in (SELECT user_id FROM members WHERE project_id = ?)
        and role != 'admin'");
        $stmt->execute([$project["id"]]);
        $appoint_students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}else{
    header("Location: not_found.php");
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
        <div class="col-md-7">
            <div class="project-info-box mt-0">
                <h5><?php echo $project["name"] ?></h5>
                <p class="mb-0">
                    <?php echo $project["description"]; ?>
                </p>
            </div>

            <div class="project-info-box mt-4">
                <p><b>Id:</b><?php echo " {$project["id"]}" ?></p>
                <p><b>Date:</b> <?php echo " {$project["semester"]} {$project["year"]}"; ?></p>
                <p><b>Instructor:</b> <?php 
                    if(!isset($instructor["name"])){
                        echo "No instructor appointed";
                    }
                    else{
                        echo $instructor["name"];
                    }
                ?></p>
                <p><b>Members:</b> <?php 
                    $names = [];
                    foreach ($members as $key => $value) {
                        array_push($names, $value["name"]);
                    } 
                    if(count($names) > 0){
                        echo implode(" , ", $names);
                    }else{
                        echo "No members appointed";
                    }
                ?></p>
                <p id="statusLabel"><b>Status:</b> <?php echo " {$project["status"]}" ?></p>
                <div class="project-info-box mt-0">
                    <h5>Requirements</h5>
                    <p class="mb-0">
                        <?php echo $project["requirements"]; ?>
                    </p>
                </div>
                <br>
                <hr>
                <div class="d-flex justify-content-around">
                    <?php
                        if( isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin"){
                            echo "<a href='#' data-bs-toggle='modal' data-bs-target='#membersModel'>Manage members</a>";
                            echo "<a href='#' data-bs-toggle='modal' data-bs-target='#instructorModel'>Appoint instructor</a>";
                            echo "<a href='#' data-bs-toggle='modal' data-bs-target='#exampleModal'>Change status</a>";
                          }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-5">
        <img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" alt="project-image" class="rounded img-fluid">
        <div class="project-info-box mt-4">
            <p><b>Software:</b> <?php echo " {$project["software"]}" ?></p>
            <p><b>Hardware:</b><?php echo " {$project["hardware"]}" ?></p>
        </div>
        </div>
    </div>
    <div>
        <!-- Requirements can be here as well  -->

                <!-- Modal -->
               
                
        <?php
            if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin"){
                include "admin_management.php";
            }
        
        ?>
    </div>
    </div>
  </main>
  
</body>
</html>