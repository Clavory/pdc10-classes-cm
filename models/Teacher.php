<?php

namespace models;
use \PDO;

class Teacher
{
    protected $teacher_id;
    protected $teacher_first_name;
    protected $teacher_last_name;
    protected $teacher_email;
    protected $teacher_contact;
    protected $employee_number;

    protected $connection;

    public function __construct($teacher_first_name, $teacher_last_name, $teacher_email, $teacher_contact, $employee_number)
    {
        $this->teacher_first_name = $teacher_first_name;
        $this->teacher_last_name = $teacher_last_name;
        $this->teacher_email = $teacher_email;
        $this->teacher_contact = $teacher_contact;
        $this->employee_number = $employee_number;
    }


    public function getId()
	{
		return $this->teacher_id;
	}

	public function getFirstName()
	{
		return $this->teacher_first_name;
	}

	public function getLastName()
	{
		return $this->teacher_last_name;
	}

    public function getEmail()
	{
		return $this->teacher_email;
	}

    public function getContactNumber()
	{
		return $this->teacher_contact;
    }

    public function getEmployeeNumber()
	{
		return $this->employee_number;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addTeacher()
	{
		try {
			$sql = "INSERT INTO teachers SET teacher_first_name=:teacher_first_name, teacher_last_name=:teacher_last_name, teacher_email=:teacher_email, teacher_contact=:teacher_contact, employee_number=:employee_number";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':teacher_first_name' => $this->getFirstName(),
				':teacher_last_name' => $this->getLastName(),
                ':teacher_email'=> $this->getEmail(),
                ':teacher_contact'=> $this->getContactNumber(),
                ':employee_number' => $this->getEmployeeNumber()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($teacher_first_name, $teacher_last_name, $teacher_email, $teacher_contact, $employee_number)
	{
		try {
			$sql = 'UPDATE teachers SET teacher_first_name=?, teacher_last_name=?, teacher_email=?, teacher_contact=?, employee_number=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$teacher_first_name,
                $teacher_last_name,
				$teacher_email,
				$teacher_contact,
                $employee_number,
                $this->getId()

			]);
			$this->teacher_first_name = $teacher_first_name;
			$this->teacher_last_name = $teacher_last_name;
			$this->teacher_email = $teacher_email;
			$this->teacher_contact = $teacher_contact;
			$this->employee_number = $employee_number;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function delete()
	{
		try {
			$sql = 'DELETE FROM teachers WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
		{
			try {
				$sql = 'SELECT * FROM teachers WHERE teacher_id=:teacher_id';
				$statement = $this->connection->prepare($sql);
				$statement->execute([
					':teacher_id' => $id
				]);
	
				$row = $statement->fetch();
	
				$this->teacher_id = $row['teacher_id'];
				$this->teacher_first_name = $row['teacher_first_name'];
				$this->teacher_email = $row['teacher_email'];
				$this->teacher_contact = $row['teacher_contact'];
				$this->employee_number = $row['employee_number'];
	
			} catch (Exception $e) {
				error_log($e->getMessage());
			}
		}

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM teachers';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
}

}