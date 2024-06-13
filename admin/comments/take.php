<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['agree'])) {
	$id = $_GET['agree'];
	update('comments', $id, ['status' => 'confirmed']);
	header('Location: ' . BASE_URL . 'admin-comments.php?&sort=' . $_GET['sort']);
}
