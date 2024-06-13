<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {

	$id = $_GET['delete'];
	delete('comments', $id);
	header('Location: ' . BASE_URL . 'admin-comments.php?&sort=' . $_GET['sort']);
}
