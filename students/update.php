<?php

include ("../init.php");
use Models\Student;

try{
    if (isset($_POST['id'])){
        $id = $_POST['id'];
        $student_first_name = $_POST['first_name'];
        $student_last_name = $_POST['last_name'];
        $student_number = $_POST['student_number'];
        $student_email = $_POST['email'];
        $student_contact = $_POST['contact_number'];
        $student_program = $_POST['program'];

        $student= new Student ('','','','','','','');
        $student->setConnection($connection);
        $student->getId($id);

        $student->update($student_first_name,$student_last_name,$student_number,$student_email,$student_contact,$student_program);
        echo "<script> window.location.href='index.php'; </script>";
        exit;
    }
}
catch (Exception $e) {
    error_log($e->getMessage());
}

?>
