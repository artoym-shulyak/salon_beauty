<?php
if (empty(!$_GET['date'])) {
	$currentDate = date('Y-m-d', strtotime($_GET['date']));
	$employee = selectOne('employees', ['id' => $_SESSION['id']]);
} else {
	$currentDate = date('Y-m-d');
	$employee = selectOne('employees', ['id' => $_SESSION['id']]);
}

$start_date = $currentDate; // Начало текущей недели
$end_date = date('Y-m-d', strtotime($currentDate . ' +7 days')); // Конец текущей недели
$schedules = getEmployeeScheduleForWeek($_SESSION['id'], $start_date, $end_date);
