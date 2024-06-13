<?php
$title = 'Регистрация пользователя - AniMatrix';
include('include/layout/head.php');
if (!empty($_SESSION['id'])) {
  header('location:' . BASE_URL);
}
?>

<!-- FUN REGISTER  -->
<?php include('controllers/forms/register.php'); ?>

<!-- FORM  -->
<?php include('views/forms/register.php'); ?>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>