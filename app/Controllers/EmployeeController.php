<?php

namespace App\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
	public function index()
	{
		$employees = new Employee();
		$employees = $employees->all();

		echo $this->twig->render('dashboard.twig', ['employees' => $employees]);
	}

	public function create()
	{
		echo $this->twig->render('create.twig');
	}

	public function store()
	{
		$errors = $this->validate($_POST);

		// If validation fails, redisplay the form with error messages and old input
		if (!empty($errors)) {
			echo $this->twig->render('create.twig', ['errors' => $errors, 'old' => $_POST]);
			return;
		}

		$employee = new Employee();
		$employee->create($_POST);

		//send a success message
		$this->message('success', 'Employee created successfully!');

		header('Location: /');
		exit;
	}

	public function validate($data)
	{
		$errors = [];

		if (empty($data['name'])) {
			$errors['name'] = 'Name is required.';
		}

		if (empty($data['address'])) {
			$errors['address'] = 'address is required.';
		}

		if (empty($data['salary'])) {
			$errors['salary'] = 'Salary is required.';
		}

		return $errors;
	}

	public function message($type, $message)
	{
		$_SESSION['message_type'] = $type;
		$_SESSION['message'] = $message;
	}

	public function edit()
	{
		$id = $_REQUEST['id'];
		$employee = new Employee();
		$employee = $employee->getEmployeeById($id);

		echo $this->twig->render('edit.twig', ['employee' => $employee]);
	}

	public function update()
	{
		$id = $_REQUEST['id'];
		$employee = new Employee();
		$employee = $employee->getEmployeeById($id);

		$errors = $this->validate($_POST);

		// If validation fails, redisplay the form with error messages and old input
		if (!empty($errors)) {
			echo $this->twig->render('edit.twig', ['employee' => $employee, 'errors' => $errors]);
			return;
		}

		$employee = new Employee();
		$employee->update($id, $_POST);

		//send a success message
		$this->message('success', 'Employee updated successfully!');

		header('Location: /');
		exit;
	}

	public function delete()
	{
		$id = $_REQUEST['id'];
		$employee = new Employee();
		$employee->delete($id);

		//send a success message
		$this->message('success', 'Employee deleted successfully!');

		header('Location: /');
		exit;
	}
}
