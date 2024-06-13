<?php
$fieldsAddEmployees = ['fields' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_employee'])) {
	$name = $_POST['name_employee'];
	$position_id = $_POST['position_employee'];
	$email = $_POST['email_employee'];
	$phone = $_POST['phone_employee'];
	$password = $_POST['password_employee'];
	$description = $_POST['description_employee'];

  // formatEnter($_POST);

	$_SESSION['name_employee'] = $name;
	$_SESSION['position_employee'] = $position;
	$_SESSION['email_employee'] = $email;
	$_SESSION['phone_employee'] = $phone;
	$_SESSION['password_employee'] = $password;
	$_SESSION['description_employee'] = $description;

	if ($name === '' || $position_id === '' || $phone === '' || $email === '') {

		$fieldsAddEmployees['fields'] = 'Заполняйте все поля';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$fieldsAddEmployees['fields'] = 'Введите корректный email!';
	} else if ($password === '') {
		$fieldsAddEmployees['fields'] = 'Заполнитель поле вода пароля!';
	} else {
		$isMail = selectOne('employees', ['email' => $email]);

		if ($isMail['email'] === $email) {
			$fieldsAddEmployees['fields'] = 'Такой email уже существует!';
		} else {
			$employee = [
				'name' => $name,
				'position_id' => $position_id,
				'email' => $email,
				'phone' => $phone,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'description' => $description,
				'brend_id' => $user['brend_id']
			];

			unset($_SESSION['name_employee']);
			unset($_SESSION['position_employee']);
			unset($_SESSION['email_employee']);
			unset($_SESSION['phone_employee']);
			unset($_SESSION['password_employee']);
			unset($_SESSION['description_employee']);

			insert('employees', $employee);
			header('Location: ' . BASE_URL . 'admin-employees.php');
		}
	}
}
