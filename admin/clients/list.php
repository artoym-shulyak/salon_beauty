<?php

if (isset($_GET['sort'])) {
	$sortOrder = $_GET['sort'];
}

function sortClients($sortOrder)
{
	global $pdo;

	switch ($sortOrder) {
		case 'asc':
			$sql = "SELECT id, name, email, phone, created_at FROM clients ORDER BY created_at ASC";
			break;
		case 'desc':
			$sql = "SELECT id, name, email, phone, created_at FROM clients ORDER BY created_at DESC";
			break;
		default:
			$sql = "SELECT id, name, email, phone, created_at FROM clients ORDER BY id";
			break;
	}

	$response = $pdo->prepare($sql);
	$response->execute();
	return $response->fetchAll();
}


function getClientOnlineBookings($client_id, $order_by = 'booking_date', $order_dir = 'ASC')
{
	global $pdo;

	// Проверка значений $order_by и $order_dir для предотвращения SQL-инъекций
	$valid_columns = ['booking_date', 'booking_time', 'employee_name', 'service_name', 'date_time'];
	if (!in_array($order_by, $valid_columns)) {
		$order_by = 'booking_date';
	}

	$order_dir = strtoupper($order_dir);
	if ($order_dir !== 'ASC' && $order_dir !== 'DESC') {
		$order_dir = 'ASC';
	}

	$sql = "SELECT ob.*, e.name AS employee_name, s.name AS service_name, CONCAT(ob.booking_date, ' ', ob.booking_time) AS date_time
					FROM online_bookings ob
					JOIN employees e ON ob.employee_id = e.id
					JOIN services s ON ob.service_id = s.id
					WHERE ob.client_id = :client_id
					ORDER BY $order_by $order_dir";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
	$stmt->execute();

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$clients = sortClients($sortOrder);
