<?php
$title = 'Вход - AniMatrix';
$isBody = true;
include('include/layout/head.php');
include('controllers/forms/login.php');
if (!empty($_SESSION['id'])) {
  header('location:' . BASE_URL);
}
?>

<!-- FORM  -->
<?php include('views/forms/login.php'); ?>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>