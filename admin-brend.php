<?php
$title = 'Бренд';
include('include/layout/head.php');
if (!empty($_SESSION['id'])) {
  $user = findUserById($_SESSION['id']);
}

include('admin/brend/index.php');
include('controllers/forms/edit-brend.php');
if (empty($_SESSION['id'])) {
  header('location:' . BASE_URL);
}
$positions = selectAll('positions'); 

?>

<div class="panel">
  <div class="panel__container-admin">
    <?php include_once 'views/side-menu/admin.php'; ?>
    <?php include_once 'views/panel/brend.php'; ?>
  </div>
</div>

<!-- SCRIPTS -->
<?php include('include/layout/connect-script.php'); ?>