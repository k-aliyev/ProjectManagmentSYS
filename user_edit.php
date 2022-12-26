<?php
    require "./data.php";
    require "./db.php";
    session_start();

    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get the form data
        $stmt = $db->prepare("SELECT * FROM user WHERE id = ?") ;
        $stmt->execute([$_SESSION["user_id"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        

        $username = $_POST["username"] ? $_POST["username"] : $user["username"];
        $email = $_POST["email"] ? $_POST["email"] : $user["email"];
        $name = $_POST["name"] ? $_POST["name"] : $user["name"];
        
        // Validate the form data
        $errors = [];
        if($_POST["password"] != $user["password"]){
            $errors[] = "Incorrect password";
        }
        $stmt = $db->prepare("SELECT username FROM user WHERE username = ?");
        $stmt->execute([$username]);
        if( $stmt->fetch(PDO::FETCH_ASSOC) != false && $user["username"] != $username){
            $errors[] = "Username already taken";
        }

        $stmt = $db->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if( $stmt->fetch(PDO::FETCH_ASSOC) != false && $user["email"] != $email){
            $errors[] = "Email already exists";
        }


        if(empty($errors)){
            $sql = "UPDATE user SET username = ?, name = ?, email = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$username, $name, $email, $_SESSION["user_id"]]);
        }

        
        if($_SESSION["user_role"] == 'firm'){

          $stmt = $db->prepare("SELECT * FROM address WHERE user_id = ?") ;
          $stmt->execute([$_SESSION["user_id"]]);
          $address = $stmt->fetch(PDO::FETCH_ASSOC);

          $city = $_POST["city"] ? $_POST["city"] : $address["city"];
          $address = $_POST["address"] ? $_POST["address"] : $address["address"];
          $district = $_POST["district"] ? $_POST["district"] : $address["district"];

          if(empty($errors)){
            $sql = "UPDATE address SET city = ?, district = ?, address = ? WHERE user_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$city, $district, $address, $_SESSION["user_id"]]);
            $success = "User edit successfully";
            header("Location: user.php?id={$_SESSION["user_id"]}");
        }
        }else{
          $success = "User edit successfully";
          header("Location: user.php?id={$_SESSION["user_id"]}");
        }

        
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Add the Bootstrap CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Add the Bootstrap JavaScript file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- Add the Select JS file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }

    </style>
</head>
<header>
    <?php include "nav.php"; ?>
</header>
<body style="background-color:#D3D3D3;">
    <div class="container mt-2" style="background-color:#D3D3D3;">
    <div class="row justify-content-center">
      <div class="col-md-10">
      <form method="post" action="user_edit.php">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Registration</h5>
          </div>
          <div class="card-body">
             <!-- Display errors, if any -->
                <?php if(!empty($errors)): ?>
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li class="alert alert-danger"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- Display success message, if any -->
                <?php if(isset($success)): ?>
                    <p><?= $success ?></p>
                <?php endif; ?>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="username" id="username" class="form-control form-control-lg" />
                    <label class="form-label" for="username">Username</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="name" id="name" class="form-control form-control-lg" />
                    <label class="form-label" id="nameLabel" for="name">Name</label>
                  </div>
                </div>
              </div>
              <div class="row address" <?php if($_SESSION["user_role"] != 'firm'){echo "style='display:none;'";} ?>>
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="text" name="city" id="city" class="form-control form-control-lg" />
                        <label class="form-label" for="city">City</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="text" name="district" id="district" class="form-control form-control-lg" />
                        <label class="form-label" for="district">District</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="text" name="address" id="address" class="form-control form-control-lg" />
                        <label class="form-label" for="address">Address</label>
                    </div>
                    </div>
                    </div>
              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                  <div class="form-outline w-100">
                    <input type="email" name="email" class="form-control form-control-lg" id="email" />
                    <label for="email" class="form-label">Email</label>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg" />
                        <label class="form-label" for="confirmPassword">Repeat Password</label>
                    </div>
                    </div>
                </div>
                    <div class="text-end">
                        <button id="submit" type="submit" class="btn btn-primary btn-block mb-4 mx-auto" disabled>Submit Changes</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</body>
<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

    $("#confirmPassword").on("input", function(e){
        if($("#confirmPassword").val() == $("#password").val()){
            $("#submit").prop( "disabled", false );
        }else{
            $("#submit").prop( "disabled", true );
        }
    });
</script>
</html>