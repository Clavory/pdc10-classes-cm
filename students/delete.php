<?php
include ("../init.php");
use Models\Student;

$id=$_GET['student_id'] ?? null;
$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$student->getById($student_id);
$student->delete();
echo "<script>window.location.href='index.php';</script>"
?>