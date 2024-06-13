<?php
session_start();
include '../../helpers/path.php';
include('../../routes/request.php');
unset($_SESSION['id']);
header('location:' . BASE_URL);
