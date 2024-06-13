<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
	$employee_id = $_POST['id'];
	$deleteUser = findUserById($employee_id);


	if ($deleteUser['position'] === 'Клиент') {
		delete('clients', $id);
		$stmt->execute();
		unset($_SESSION['id']);
		header('Location: ' . BASE_URL);
	} else {
		$brend_name = $deleteUser['brend'];
		// Начало транзакции
		$pdo->beginTransaction();

		// Удаление из таблицы appointments
		$sql = "DELETE FROM appointments WHERE employee_id = :employee_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
		$stmt->execute();

		// Удаление из таблицы employee_schedules
		$sql = "DELETE FROM employee_schedules WHERE employee_id = :employee_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
		$stmt->execute();

		// Удаление из таблицы employee_services
		$sql = "DELETE FROM employee_services WHERE employee_id = :employee_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
		$stmt->execute();

		// Удаление из таблицы online_bookings
		$sql = "DELETE FROM online_bookings WHERE employee_id = :employee_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
		$stmt->execute();

		if ($deleteUser['position'] === 'Администратор') {
			$sql = "DELETE FROM brends WHERE name = :brend_name";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':brend_name', $brend_name, PDO::PARAM_STR);
			$stmt->execute();

			$sql = "DELETE FROM employees WHERE brend = :brend_name";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':brend_name', $brend_name, PDO::PARAM_STR);
			$stmt->execute();
			unset($_SESSION['id']);
			header('Location: ' . BASE_URL);
		} else {
			// Удаление из таблицы employees
			$sql = "DELETE FROM employees WHERE id = :employee_id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
			$stmt->execute();
			unset($_SESSION['id']);
			header('Location: ' . BASE_URL);
		}

		// Подтверждение транзакции
		$pdo->commit();
		delete('employees', $id);
	}
}
