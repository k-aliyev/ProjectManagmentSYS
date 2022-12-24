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

        // If there are no errors, insert the user into the database
        if(empty($errors)){
            $sql = "INSERT INTO user(username, password, name, email, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$username, $password, $name, $email, $role]);
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
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Registration</h5>
          </div>
          <div class="card-body">
            <form method="post" action="registration.php">
            <div>
            </div>
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
              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                  <div class="form-outline datepicker w-100">
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
            </form>
            </div>
        </div>
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
        } else {
            $("#nameLabel").text("Name");
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