<?php
    require "./db.php";
    session_start();

    if($_POST["action"] == 'update_status'){
        $stmt = $db->prepare("UPDATE project SET status = ? WHERE id = ?");
        $stmt->execute([$_POST['status'], $_POST['project_id']]);
    }
    if($_POST["action"] == 'add_instructor'){
        $stmt = $db->prepare("UPDATE project SET advisor_id = ? WHERE id = ?");
        $stmt->execute([$_POST['instructor_id'], $_POST['project_id']]);
    }
    if($_POST["action"] == 'delete_instructor'){
        $stmt = $db->prepare("UPDATE project SET advisor_id = -1 WHERE id = ?");
        $stmt->execute([ $_POST['project_id']]);
    }
    if($_POST["action"] == 'add_member'){
        $sql = "INSERT INTO members(user_id, project_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_POST['member_id'], $_POST['project_id']]);
    }
    if($_POST["action"] == 'delete_member'){
        $sql = "DELETE FROM members WHERE user_id = ? and project_id = ?" ;
        $stmt = $db->prepare($sql);
        $stmt->execute([$_POST['member_id'], $_POST['project_id']]);
    }

?>