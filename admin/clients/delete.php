<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_client_id'])) {
	delete('clients', $_GET['del_client_id']);
	header('Location: ' . BASE_URL . 'admin-clients.php');
}
