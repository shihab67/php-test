<?php

namespace App\Models;

class Employee
{
	private $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function all()
	{
		$stmt = $this->db->getConnection()->prepare("SELECT * FROM employees ORDER BY id DESC");
		$stmt->execute();

		$result = $stmt->get_result();
		$users = $result->fetch_all(MYSQLI_ASSOC);

		$stmt->close();

		return $users;
	}

	public function create($data)
	{
		$this->db->getConnection()->query("INSERT INTO employees(name, address, salary) VALUES ('" . $data['name'] . "', '" . $data['address'] . "', '" . $data['salary'] . "')");
	}

	public function getEmployeeById($employeeId)
	{
		$stmt = $this->db->getConnection()->prepare("SELECT * FROM employees WHERE id = ?");
		$stmt->bind_param("i", $employeeId); // "i" represents integer, adjust as needed
		$stmt->execute();

		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

		$stmt->close();

		return $user;
	}

	public function update($id, $data)
	{
		$this->db->getConnection()->query("UPDATE employees SET name = '" . $data['name'] . "', address = '" . $data['address'] . "', salary = '" . $data['salary'] . "' WHERE id = " . $id);
	}

	public function delete($id)
	{
		$this->db->getConnection()->query("DELETE FROM employees WHERE id = " . $id);
	}
}
