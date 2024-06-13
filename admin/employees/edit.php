<?php
$fieldsEditEmployee = ['fields' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_employee'])) {
	$name = $_POST['name_employee'];
	// $position = $_POST['position_employee'];
	$email = $_POST['email_employee'];
	$phone = $_POST['phone_employee'];
	$description = $_POST['description_employee'];
	$id = $_POST['id_employee'];

  // formatEnter($_POST);

	if ($name === '' || $phone === '' || $email === '') {
		$fieldsEditEmployee['fields'] = 'Не все поля заполнены!';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$fieldsEditEmployee['fields'] = 'Введите корректный email!';
	} else {
		$isMail = selectOne('employees', ['email' => $email]);
		$updateEmployee = [
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'description' => $description
		];

		update('employees', $id, $updateEmployee);
		header('Location: ' . BASE_URL . 'admin-employees.php');
	}
}
