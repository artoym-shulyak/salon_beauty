<?php
function addOnlineBooking($client_id, $employee_id, $service_id, $booking_date, $booking_time)
{
	global $pdo;

	$sql = "INSERT INTO online_bookings (client_id, employee_id, service_id, booking_date, booking_time) VALUES (:client_id, :employee_id, :service_id, :booking_date, :booking_time)";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
	$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
	$stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
	$stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
	$stmt->bindParam(':booking_time', $booking_time, PDO::PARAM_STR);
	$stmt->execute();
}


// Пример использования функции
$client_id = 1;
$employee_id = 2;
$service_id = 3;
$booking_date = '2024-06-01';
$booking_time = '10:00:00';

// addOnlineBooking($client_id, $employee_id, $service_id, $booking_date, $booking_time);
// addOnlineBooking(24, 21, 19, $booking_date, $booking_time);
