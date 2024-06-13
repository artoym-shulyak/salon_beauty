<?php
session_start();
include 'helpers/path.php';
include('routes/request.php');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css?_v=20240510171919" />
    <link rel="stylesheet" href="assets/css/style.min.css?_v=20240510171919">
    <link rel="stylesheet" href="assets/css/more.css">
    <title><?= $title; ?></title>
</head>

<?php if (isset($isBody)): ?>
  <style type="text/css">
    body::before {
     background-image:none !important; 
    }
  </style>
<?php else :?>
  <body>
<?php endif ?>

  <a href="<?= BASE_URL . 'online-booking.php' ?>" class="pulse-button">Записаться ONLINE</a>
    <div class="wrapper">