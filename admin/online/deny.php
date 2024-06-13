<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['deny_online'])) {
	$online_booking_id = $_GET['deny_online'];

	global $pdo;

	// Обновление статуса в таблице appointments по online_booking_id
	$sql = "UPDATE appointments SET status = 'free' WHERE online_booking_id = :online_booking_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':online_booking_id', $online_booking_id, PDO::PARAM_INT);
	$stmt->execute();

	// Обновление статуса в таблице online_bookings
	update('online_bookings', $online_booking_id, ["status" => 'cancelled']);
}
