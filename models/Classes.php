<?php

namespace models;
use \PDO;

class Classes
{
    protected $class_id;
    protected $class_name;
    protected $class_desc;
    protected $class_code;
    protected $teacher_id;

    protected $connection;

    public function __construct($class_name, $class_desc, $class_code, $teacher_id)
    {
        $this->class_name = $class_name;
        $this->class_desc = $class_desc;
        $this->class_code = $class_code;
        $this->teacher_id = $teacher_id;
    }


    public function getId()
	{
		return $this->class_id;
	}

	public function getName()
	{
		return $this->class_name;
	}

	public function getDescription()
	{
		return $this->class_desc;
	}

    public function getClassCode()
	{
		return $this->class_code;
	}

    public function getTeacherId()
	{
		return $this->teacher_id;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function save()
	{
		try {
			$sql = "INSERT INTO classes SET class_name=:class_name, class_desc=:class_desc, class_code=:class_code, teacher_id=:teacher_id";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':class_name' => $this->getName(),
				':class_desc' => $this->getDescription(),
                ':class_code' => $this->getClassCode(),
                ':teacher_id'=> $this->getTeacherId(),

			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($class_name, $class_desc, $class_code, $teacher_id)
	{
		try {
			$sql = 'UPDATE classes SET class_name=?, class_desc=?, class_code=?, teacher_id=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$class_name,
                $class_desc,
				$class_code,
				$teacher_id,
                $this->getId()

			]);
			$this->class_name = $class_name;
			$this->class_desc = $class_desc;
			$this->class_code = $class_code;
			$this->teacher_id = $teacher_id;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function delete()
	{
		try {
			$sql = 'DELETE FROM classes WHERE class_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function fetchClass($id){
		try{
			$sql = 'SELECT *FROM classes WHERE class-id=?';
			$statement = $this -> connection-> prepare($sql);
			$statement->execute([$id]);

			$data= $statement->fetchAll();
			return $data;
		} catch (Exception $e){
			error_log($e-> getMessage());
		}
		}

		public function getById($id)
		{
			try {
				$sql = 'SELECT * FROM classes WHERE class_id=:class_id';
				$statement = $this->connection->prepare($sql);
				$statement->execute([
					':class_id' => $id
				]);
	
				$row = $statement->fetch();
	
				$this->id = $row['class_id'];
				$this->teacher_first_name = $row['class_name'];
				$this->teacher_email = $row['class_desc'];
				$this->teacher_contact = $row['class_code'];
				$this->employee_number = $row['teacher_id'];
	
			} catch (Exception $e) {
				error_log($e->getMessage());
			}
		}
	


    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM classes';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
}

}