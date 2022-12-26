<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">STARS2</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="list.php">All Projects</a>
        </li>
        <?php
          if(isset($_SESSION["user_role"]) && in_array($_SESSION["user_role"], $roles)){
            echo "<li class='nav-item'>
                    <a class='nav-link active' href='list.php?type=r'>My Projects</a>
                  </li>";
          }
          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){
            echo "<li class='nav-item'>
                    <a class='nav-link active' href='user.php'>Account</a>
                  </li>";
          }
        ?>
      </ul>
      <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){
          echo "<span class='navbar-text'><a href='logout.php'>Log Out</a></span>";
        }
        else{
          echo "<span class='navbar-text'><a href='login.php'>Log In</a></span>";
        }
      ?>
    </div>
  </div>
</nav>