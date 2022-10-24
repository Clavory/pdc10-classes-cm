<?php

include ("../init.php");
use Models\Teacher;



try{

    if (isset($_POST['id'])){
    $id = $_POST['id'];


        $teacher= new Teacher ('','','','','','');
        $teacher->setConnection($connection);
        $teacher->getById($id);

        $first_name = $_POST['teacher_first_name'];
        $last_name = $_POST['teacher_last_name'];
        $email = $_POST['teacher_email'];
        $contact_number = $_POST['teacher_contact'];
        $employee_number = $_POST['employee_number'];



        $teacher->update($teacher_first_name,$teacher_last_name,$teacher_email,$teacher_contact,$employee_number);
        echo "<script> window.location.href='index.php'; </script>";
        exit;
    }
}
catch (Exception $e) {
    error_log($e->getMessage());
}

?>