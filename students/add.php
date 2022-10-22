<?php

include ("../init.php");
use Models\Student;

$template = $mustache->loadTemplate('students/add.mustache');
echo $template->render();

try {
    if (isset($_POST['student_first_name'])) {
        $addStudent = new Student($_POST['student_first_name'], $_POST['student_last_name'], $_POST['student_number'], $_POST['student_email'], $_POST['student_contact'], $_POST['student_program']);
        $addStudent->setConnection($connection);
        $addStudent->addStudent();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());
}