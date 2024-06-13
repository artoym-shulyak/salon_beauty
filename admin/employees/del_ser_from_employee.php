<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_service_from_emp'])) {
	global $pdo;
	$id = $_GET['del_service_from_emp'];
	$sql = "DELETE FROM `employee_services` WHERE service_id = $id";
	$response = $pdo->prepare($sql);
	$response->execute();
	dbCheckError($response);
	header('Location: ' . BASE_URL . 'admin-employees.php');
}
