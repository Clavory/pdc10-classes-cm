<?php

include ("../init.php");
use Models\Teacher;

$template = $mustache->loadTemplate('teachers/add.mustache');
echo $template->render();

try {
    if (isset($_POST['teacher_first_name'])) {
        $addTeacher = new Teacher($_POST['teacher_first_name'], $_POST['teacher_last_name'], $_POST['teacher_email'], $_POST['teacher_contact'], $_POST['employee_number']);
        $addTeacher->setConnection($connection);
        $addTeacher->addTeacher();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());

}