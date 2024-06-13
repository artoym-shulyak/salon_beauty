<?php
$title = 'Расписание';
include('include/layout/head.php');
if (!empty($_SESSION['id'])) {
  $user = findUserById($_SESSION['id']);
}

include('admin/calendar/list.php');
if (empty($_SESSION['id'])) {
	header('location:' . BASE_URL);
}
?>

<div class="panel">
	<div class="panel__container-admin">
		<?php
		if ($user['position_id'] == 4) {
			include_once 'views/side-menu/admin.php';
		} else if ($user['position_id'] == 5) {
			include_once 'views/side-menu/client.php';
		} else {
			include_once 'views/side-menu/master.php';
		}
		?>
		<?php include_once 'views/panel/schedule.php'; ?>
	</div>
</div>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>