<?php
session_start();

require "./data.php";
require "./db.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && in_array($_SESSION["user_role"], $roles)){
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

        $sql = "INSERT INTO project(id, name, description, requirements, software, hardware, status, year, semester, advisor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id + 1, $name, $_POST["description"], $_POST["requirements"],$_POST["software"],$_POST["hardware"],"waiting",date("Y"), $_POST["semester"], -1]);

        $sql = "INSERT INTO members(user_id, project_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_SESSION["user_id"], $id + 1]);
        header("Location: list.php?type=r");
    }
}
else if($_SERVER["REQUEST_METHOD"] == "GET" && in_array($_SESSION["user_role"], $roles)){
    include "create_authorized.php";
}else{
    header("Location: not_authorized.php");
}

?>