<?php
    require "./db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
<!-- Add the Bootstrap CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
<!-- Add the Bootstrap JavaScript file -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
    <div class="container mt-5" style="background-color:#D3D3D3;">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Log In</h5>
                    </div>
                    <div class="card-body">
                    <form method="post" action="login.php">
                        <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                            
                                $username = $_POST["username"];
                                $password = $_POST["password"];
                        
                                // Check if the username and password are correct
                                $sql = "SELECT * FROM user WHERE username= ? AND password= ?";
                                $stmt = $db->prepare($sql) ;
                                $stmt->execute([$username, $password]) ;
                                $item = $stmt->fetch(PDO::FETCH_ASSOC);
                                if($item!=null){
                                    session_start();
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["user_id"] = $item["id"];
                                    $_SESSION["user_role"] = $item["role"];
                                    $_SESSION["username"] = $item["username"];
                                    header("Location: list.php");
                                }else{
                                    echo "<div class='alert alert-danger' role='alert'>Invalid username or password</div>";
                                }
                            }
                        ?>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="username" class="form-control" />
                            <label class="form-label" for="form2Example1">Username</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control" />
                            <label class="form-label" for="form2Example2">Password</label>
                        </div>

                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4 text-center">
                            <a href="#!">Forgot password?</a>
                        </div>
                        <!-- Submit button -->
                        <div class="row mb-4 text-center">
                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                        </div>
                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Not a member? <a href="registration.php">Register</a>
                            </p>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
