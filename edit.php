<?php
switch ($_SESSION["user_role"] ) {
  case 'student':
    include "edit_student.php";
    break;
  case 'admin':
    include "edit_admin.php";
    break;
  case 'instructor':
  include "edit_instructor.php";
    break;
  case 'firm':
    include "edit_firm.php";
    break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>