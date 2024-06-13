<?php
if (empty(!$_GET['date'])) {
	$currentDate = date('Y-m-d', strtotime($_GET['date']));
} else {
	$currentDate = date('Y-m-d');
}

// Пример использования функции
$start_date = $currentDate; // Начало текущей недели
$end_date = date('Y-m-d', strtotime($currentDate . ' +7 days')); // Конец текущей недели
$employees = selectAll('employees', ['brend_id' => $user['brend_id']]);
$services = selectAll('services');
