<?php
 require "./db.php";

if(isset($_POST['submit'])){

    $stmt = $db->query("SELECT count(*) from project_files");
    $id = $stmt->fetchColumn();

    //$title = $_POST["title"];
   // echo "$title";
   $project_name = $_POST["projectName"];

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];
    $fileTempName = $_FILES['file']['tmp_name'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    if($fileError === 0){
        if($fileSize < 100000000){
            //unique id
            $fileNewName = uniqid('' , true).".".$fileActualExt;

            $fileDestination = 'uploads/' . $fileNewName;
            move_uploaded_file($fileTempName, $fileDestination);

            //insert
            $sql = "INSERT INTO project_files(record_id, filename, project_name) VALUES( ? , ? , ?)";
            $stmt = $db -> prepare($sql);
            $stmt-> execute([$id + 1, $fileNewName , $project_name]);
            
            //echo "Added";
            header("Location: list.php ");

        }else{
            echo "Your file is too big";
        }
    }else{
        echo "There was an error uploading the file!";
    }

}
?>