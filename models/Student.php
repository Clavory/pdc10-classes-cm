<?php

namespace models;
use \PDO;

class Student
{
    protected $student_id;
    protected $student_first_name;
    protected $student_last_name;
    protected $student_number;
    protected $student_email;
    protected $student_contact;
    protected $student_program;

    protected $connection;

    public function __construct($student_first_name, $student_last_name, $student_number, $student_email, $student_contact, $student_program)
    {
        $this->student_first_name = $student_first_name;
        $this->student_last_name = $student_last_name;
        $this->student_number = $student_number;
        $this->student_email = $student_email;
        $this->student_contact = $student_contact;
        $this->student_program = $student_program;
    }


    public function getStudentId()
	{
		return $this->student_id;
	}

	public function getFirstName()
	{
		return $this->student_first_name;
	}

	public function getLastName()
	{
		return $this->student_last_name;
	}

	public function getStudentNumber()
	{
		return $this->student_number;
	}

    public function getEmail()
	{
		return $this->student_email;
	}

    public function getContactNumber()
	{
		return $this->student_contact;
    }

    public function getProgram()
	{
		return $this->student_program;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addStudent()
	{
		try {
			$sql = "INSERT INTO students SET student_first_name=:student_first_name, student_last_name=:student_last_name, student_number=:student_number, student_email=:student_email, student_contact=:student_contact, student_program=:student_program";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':student_first_name' => $this->getFirstName(),
				':student_last_name' => $this->getLastName(),
                ':student_number' => $this->getStudentNumber(),
                ':student_email'=> $this->getEmail(),
                ':student_contact'=> $this->getContactNumber(),
                ':student_program'=> $this->getProgram(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($student_first_name, $student_last_name, $student_number, $student_email, $student_contact, $student_program)
	{
		try {
			$sql = 'UPDATE students SET student_first_name=?, student_last_name=?, student_number=?, student_email=?, student_contact=?, student_program=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$student_first_name,
                $student_last_name,
				$student_number,
				$student_email,
				$student_contact,
				$student_program,
                $this->getId()

			]);
			$this->student_first_name = $student_first_name;
			$this->student_last_name = $student_last_name;
			$this->student_number = $student_number;
			$this->student_email = $student_email;
			$this->student_contact = $student_contact;
			$this->student_program = $student_program;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function delete()
	{
		try {
			$sql = 'DELETE FROM students WHERE student_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getStudentId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM students';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
}

}