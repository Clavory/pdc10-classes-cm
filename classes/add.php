<?php

include ("../init.php");
use Models\Student;

$template = $mustache->loadTemplate('classes/add.mustache');
echo $template->render();

try {
    if (isset($_POST['first_name'])) {
        $addStudent = new Student($_POST['class_name'], $_POST['class_code'], $_POST['class_desc']);
        $addStudent->setConnection($connection);
        $addStudent->addStudent();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());
}