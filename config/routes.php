<?php

use App\Controllers\EmployeeController;

return [
	'/' => [
		'GET' => [EmployeeController::class, 'index']
	],
	'/create' => [
		'GET' => [EmployeeController::class, 'create']
	],
	'/store' => [
		'POST' => [EmployeeController::class, 'store']
	],
	'/edit' => [
		'GET' => [EmployeeController::class, 'edit']
	],
	'/update' => [
		'POST' => [EmployeeController::class, 'update']
	],
	'/delete' => [
		'GET' => [EmployeeController::class, 'delete']
	],
];
