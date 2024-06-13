<?php
$title = 'Личый Кабинет';
include('include/layout/head.php');
if (empty($_SESSION['id'])) {
  header('location:' . BASE_URL);
} else {
  $user = findUserById($_SESSION['id']);
}

include('controllers/forms/change-data.php');
include('controllers/forms/change-password.php');
include('controllers/forms/change-phone.php');
include('controllers/forms/change-email.php');
include('controllers/forms/delete-account.php');
include('controllers/forms/edit-brend.php');

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
		include_once 'views/panel/personal.php';
		?>
	</div>
</div>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>