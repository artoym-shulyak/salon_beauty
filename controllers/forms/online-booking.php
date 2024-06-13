<?php

session_start();
$successBooking = '';
function create($table, $data)
{
	global $pdo;
	$sql = "INSERT INTO $table (" . implode(', ', array_keys($data)) . ") VALUES (" . implode(', ', array_map(function ($key) {
		return ":$key";
	}, array_keys($data))) . ")";
	$stmt = $pdo->prepare($sql);
	$stmt->execute($data);
	return $pdo->lastInsertId();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking'])) {
	global $pdo;
	$client_name = $_POST['client_name'];
	$client_email = $_POST['client_email'];
	$client_phone = $_POST['client_phone'];
	$employee_id = $_POST['employee_id'];
	$service_id = $_POST['id_service'];
	$booking_date = $_POST['booking_date'];
	$booking_time = $_POST['booking_time'];
	$appointment_id = $_POST['appointment_id'];

  // formatEnter($_POST);

	// Проверка и очистка данных
	$client_name = filter_var($client_name, FILTER_SANITIZE_STRING);
	$employee_id = filter_var($employee_id, FILTER_VALIDATE_INT);
	$booking_date = filter_var($booking_date, FILTER_SANITIZE_STRING);
	$booking_time = filter_var($booking_time, FILTER_SANITIZE_STRING);

	// Проверка существования клиента в базе данных
	$client = selectOne('clients', ['name' => $client_name]);
	if (!$client) {
		// Если клиента нет, создаем нового клиента
		$client_id = create('clients', [
			'name' => $client_name,
			'email' => $client_email,
			'phone' => $client_phone,
			'position_id' => 5
		]);
	} else {
		$client_id = $client['id'];
	}


	// Обновление статуса в таблице appointments по online_booking_id
	// foreach ($service_ids as $service_id) {
	// 	$sql = "DELETE FROM `appointment_services` WHERE appointment_id = $appointment_id";
	// 	$response = $pdo->prepare($sql);
	// 	$response->execute();
	// }

	// Создание записей в appointment_services
		$service_id = filter_var($service_id, FILTER_VALIDATE_INT);
		create('appointment_services', [
			'appointment_id' => $appointment_id,
			'service_id' => $service_id
		]);

	// Создание записи в online_bookings
	$booking_data = [
		'client_id' => $client_id,
		'employee_id' => $employee_id,
		'booking_date' => $booking_date,
		'booking_time' => $booking_time,
		'status' => 'pending' // или 'рассматривается'
	];
	$online_booking_id = create('online_bookings', $booking_data);
	update('appointments', $appointment_id, ['status' => 'pending', 'online_booking_id' => $online_booking_id]);
	$successBooking = 'Спасибо за запись. В скором времени на Вашу почту' . ' ' . $client_email . ' ' .  'придет подтверждение.';
	// header('Location: admin-online.php');
}
