<?php

include ("../init.php");
use Models\Student;

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$all_students = $student->getAll();

$template = $mustache->loadTemplate('students/index');
echo $template->render(compact('all_students'));