<?php


$successSend = '';
$successSendEmp = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_comment_emp'])) {
	global $pdo;

	$employee_id = $_POST['employee_id'];
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	$client_id = null; // По умолчанию, это отзыв гостя

	// Проверка, зарегистрирован ли клиент
	$client = selectOne('clients', ['email' => $email]);
	if ($client) {
		$client_id = $client['id'];
	}

	// Вставка комментария
	$sql = "
			INSERT INTO comments (client_id, employee_id, guest_name, guest_email, comment, created_at)
			VALUES (:client_id, :employee_id, :guest_name, :guest_email, :comment, NOW())
	";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
	$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
	$stmt->bindParam(':guest_name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':guest_email', $email, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $message, PDO::PARAM_STR);
	$stmt->execute();

	// Перенаправление или сообщение об успешной отправке отзыва
	$successSendEmp = 'Спасибо за ваш отзыв о сотруднике! Мы очень ценим ваши комментарии и всегда стремимся улучшать наш сервис. Ваш отзыв будет проверен модератором и опубликован в ближайшее время.';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_comment_brend'])) {
	global $pdo;

	$brend_id = $_POST['brend_id'];
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	$client_id = null; // По умолчанию, это отзыв гостя

	// Проверка, зарегистрирован ли клиент
	$client = selectOne('clients', ['email' => $email]);
	if ($client) {
		$client_id = $client['id'];
	}

	// Вставка комментария
	$sql = "
			INSERT INTO comments (client_id, brend_id, guest_name, guest_email, comment, created_at)
			VALUES (:client_id, :brend_id, :guest_name, :guest_email, :comment, NOW())
	";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
	$stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
	$stmt->bindParam(':guest_name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':guest_email', $email, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $message, PDO::PARAM_STR);
	$stmt->execute();

	$successSend = 'Спасибо за ваш отзыв! Мы очень ценим ваши комментарии и всегда стремимся улучшать наш сервис. Ваш отзыв будет проверен модератором и опубликован в ближайшее время.';
}
