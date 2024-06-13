<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['disagree'])) {
	$id = $_GET['disagree'];
	update('comments', $id, ['status' => 'calcelled']);
	header('Location: ' . BASE_URL . 'admin-comments.php?&sort=' . $_GET['sort']);
}
