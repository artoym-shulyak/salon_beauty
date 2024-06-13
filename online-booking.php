<?php
session_start();
$title = 'Онлайн запись';
include('include/layout/head.php');
if (!empty($_SESSION['id'])) {
  $user = findUserById($_SESSION['id']);
}

include('admin/booking/index.php');
include('controllers/forms/online-booking.php');
include('controllers/forms/send_comment.php');
?>

<div class="panel">
	<div class="panel__container-admin">
		<div class="panel__booking booking">
      <?php include('views/formBooking/head.php'); ?>
      <?php include('views/formBooking/brends.php'); ?>
      <?php if (!empty($successSend)) : ?>
        <div class="success _block"><?= $successSend; ?></div>
      <?php endif ?>
      <?php include('views/formBooking/employees.php'); ?>
      <?php include('views/formBooking/services.php'); ?>
      <?php include('views/formBooking/time.php'); ?>
      <?php include('views/formBooking/result.php'); ?>
      <?php include('views/formBooking/page.php'); ?>
		</div>
	</div>
</div>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>

<!-- employee, service, appointment -->