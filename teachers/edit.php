<?php

include ("../init.php");
use Models\Teacher;

    $id = $_GET['id'];

    $teacher = new Teacher('','','','','');
    $teacher->setConnection($connection);
    $teacher->getById($id);
    $first_name = $teacher->getFirstName();
    $last_name = $teacher->getLastName();
    $email = $teacher->getEmail();
    $contact = $teacher->getContactNumber();
    $employee_number = $teacher->getEmployeeNumber();
    

    // $all_teachers= $teacher->showAllTeachers();

    // echo $mustache->render('teacher/edit', compact('teacher'));

    $template = $mustache->loadTemplate('teachers/edit.mustache');
    echo $template->render(compact('id', 'teacher', 'first_name', 'last_name', 'email', 'contact', 'employee_number',));

?>