<?php
session_start();

require "./data.php";
require "./db.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["user_role"] == "admin"){
    // Get the form data
    $name = $_POST["name"];

    // Validate the form data
    $errors = [];
    if(empty($name)){
        $errors[] = "Project name is required";
    }

    // If there are no errors, insert the user into the database
    if(empty($errors)){
        $stmt = $db->query("SELECT count(*) from project");
        $id = $stmt->fetchColumn();

        echo $id;

        $sql = "INSERT INTO project(id, name, description, requirements, software, hardware, status, year, semester, advisor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id + 1, $name, $_POST["description"], $_POST["requirements"],$_POST["software"],$_POST["hardware"],"waiting",date("Y"), $_POST["semester"], -1]);

        $sql = "INSERT INTO members(user_id, project_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_SESSION["user_id"], $id + 1]);
        header("Location: list.php?type=r");
    }
}


if(isset($_SESSION["user_role"])){
    if($_SESSION["user_role"] == "firm" || $_SESSION["user_role"] == "student" || $_SESSION["user_role"] == "instructor")
    {
        // include "create_authorized.php";
    }else if($_SESSION["user_role"] == "admin"){
        include "create_authorized.php";
    }else{
        header("Location: login.php");
    }
}
else{
    // header("Location: login.php");
}

?>