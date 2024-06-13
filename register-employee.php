<?php
$title = 'Регистрация - AniMatrix';
include('include/layout/head.php');
$brends = selectAll('brends');
if (!empty($_SESSION['id'])) {
  header('location:' . BASE_URL);
}
?>

<!-- FUN REGISTER  -->
<?php include('controllers/forms/register-employee.php'); ?>

<!-- FORM  -->
<?php include('views/forms/register-employee.php'); ?>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>