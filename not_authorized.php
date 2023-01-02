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
        <div class="card text-center">
    <div class="card-header">
        401 Unauthorized
    </div>
    <div class="card-body">
        <h5 class="card-title">Your are not authorized for this page</h5>
        <p class="card-text">If you having problem accessing this page, please contact our support center</p>
        <a href="list.php" class="btn btn-primary">Go to project lists</a>
    </div>
    <div class="card-footer text-muted">
        or you can <a href="login.php">login here</a>
    </div>
    </div>
    </div>
  </main>
</body>
</html>