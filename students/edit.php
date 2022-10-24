<?php

include ("../init.php");
use Models\Student;

    $id = $_GET['id'];

    $student = new Student('','','','','','');
    $student->setConnection($connection);
    $student->getId($id);
    $student_first_name = $student->getFirstName();
    $student_last_name = $student->getLastName();
    $student_number = $student->getStudentNumber();
    $student_email = $student->getEmail();
    $student_contact = $student->getContactNumber();
    $student_program = $student->getProgram();

    // $all_students = $student->showAllStudents();

    // echo $mustache->render('student/edit', compact('student'));

    $template = $mustache->loadTemplate('students/edit.mustache');
    echo $template->render(compact('id', 'student', 'student_first_name', 'student_last_name', 'student_number', 'student_email', 'student_contact', 'student_program'));

?>