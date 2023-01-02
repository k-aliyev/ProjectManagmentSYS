<?php
 require "./db.php";

   $user_id = $_GET["user_id"];
   $project_id = $_GET["project_id"];
   echo "$id";

    if(isset($_POST['submit'])){
 
     $comments = $_POST["comment"];
 
    //insert
    $sql = "INSERT INTO comments(pid, user_id ,comment) VALUES( ? , ?, ? )";
    $stmt = $db -> prepare($sql);
    $stmt-> execute([$project_id, $user_id, $comments]);
    header("Location: list.php ");
             
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Add the Bootstrap CSS file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <!-- Add the Bootstrap JavaScript file -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>UploadFiles</title>
</head>
<body>
    <h2>Add Comment</h2>
    <form action="" method="post">
        <div class="col-md-12">
            <label for="title">Add comments to project</label>
            <input type="text" name="comment" id="comment">
             <br>
             <br>
             <button class="btn btn-primary ml-auto" type="submit" name="submit">Add comment</button>
        </div>
    </form>
</body>
</html>

