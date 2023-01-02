<?php
    // Connect to the database
    require "./db.php";

    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get the form data
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $role = $_POST["inlineRadioOptions"];
        $name = $_POST["name"];


        // Validate the form data
        $errors = [];
        if(empty($username)){
            $errors[] = "Username is required";
        }
        if(empty($email)){
            $errors[] = "Email is required";
        }
        if(empty($password)){
            $errors[] = "Password is required";
        }
        if($password != $confirmPassword){
            $errors[] = "Passwords do not match";
        }
        $stmt = $db->prepare("SELECT username FROM user WHERE username = ?");
        $stmt->execute([$username]);
        if( $stmt->fetch(PDO::FETCH_ASSOC) != false){
            $errors[] = "Username already taken";
        }

        $stmt = $db->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if( $stmt->fetch(PDO::FETCH_ASSOC) != false){
            $errors[] = "Email already exists";
        }

        // If there are no errors, insert the user into the database
        if(empty($errors)){
            $sql = "INSERT INTO user(username, password, name, email, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$username, $password, $name, $email, $role]);
        }

        
        if($role == 'firm'){
          $city = $_POST["city"];
          $address = $_POST["address"];
          $district = $_POST["district"];
          
          $stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
          $stmt->execute([$username]);
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
          $success = "User registered successfully";
          header("Location: login.php");
        }

        if(empty($city)){
            $errors[] = "City is required";
        }
        if(empty($address)){
            $errors[] = "Address is required";
        }
        if(empty($district)){
            $errors[] = "District is required";
        }

        if(empty($errors)){
          $sql = "INSERT INTO address(user_id, city, district, address) VALUES (?, ?, ?, ?)";
          $stmt = $db->prepare($sql);
          $stmt->execute([$user["id"], $city, $district, $address]);
          $success = "User registered successfully";
          header("Location: login.php");
      }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
        .address{
          display:none;
        }

    </style>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">STARS2</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>
        <span class="navbar-text"><a href="login.php" >Log in</a></span>
        
        </div>
    </div>
    </nav>
</header>
<body style="background-color:#D3D3D3;">
    <div class="container mt-2" style="background-color:#D3D3D3;">
    <div class="row justify-content-center">
      <div class="col-md-10">
      <form method="post" action="registration.php">
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
                    <input required type="text" name="username" id="username" class="form-control form-control-lg" />
                    <label class="form-label" for="username">Username</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input required type="text" name="name" id="name" class="form-control form-control-lg" />
                    <label class="form-label" id="nameLabel" for="name">Name</label>
                  </div>
                </div>
              </div>
              <div class="row address">
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input required type="text" name="city" id="city" class="form-control form-control-lg" />
                        <label class="form-label" for="city">City</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input required type="text" name="district" id="district" class="form-control form-control-lg" />
                        <label class="form-label" for="district">District</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input required type="text" name="address" id="address" class="form-control form-control-lg" />
                        <label class="form-label" for="address">Address</label>
                    </div>
                    </div>
                    </div>
              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                  <div class="form-outline w-100">
                    <input required type="email" name="email" class="form-control form-control-lg" id="email" />
                    <label for="email" class="form-label">Email</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <h6 class="mb-2 pb-1">Role: </h6>
                  <div class="form-check form-check-inline" style="margin-right: 24px;">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="admin" value="admin" required />
                    <label class="form-check-label" for="admin">Admin</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="instructor" value="instructor" />
                    <label class="form-check-label" for="instructor">Instructor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="student" value="student" />
                    <label class="form-check-label" for="student">Student</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="firm" value="firm" />
                    <label class="form-check-label" for="firm">Firm User</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input required type="password" name="password" id="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input required type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg" />
                        <label class="form-label" for="confirmPassword">Repeat Password</label>
                    </div>
                    </div>
                </div>
                
                    <div style="width:400px; margin: auto;">
                        <button id="submit" type="submit" class="btn btn-primary btn-block mb-4" disabled>Register</button>
                    </div>
                    <div class="text-center">
                        <p>Already registered? <a href="login.php">Log In</a>
                        </p>
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
    $("input[name='inlineRadioOptions']").change(function(e){
        if($(this).val() == 'firm') {
            $("#nameLabel").text("Firm Name");
            $(".address").css("display", "flex");
            $(".address :input").prop('required',true);
        } else {
            $("#nameLabel").text("Name");
            $(".address").css("display", "none");
            $(".address :input").prop('required',false);
        }
    });

    $("#confirmPassword").on("input", function(e){
        if($("#confirmPassword").val() == $("#password").val()){
            $("#submit").prop( "disabled", false );
        }else{
            $("#submit").prop( "disabled", true );
        }
    });
</script>
</html>