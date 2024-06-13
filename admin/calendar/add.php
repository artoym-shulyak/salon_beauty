<?php
$fieldsAddSchedule = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_schedule'])) {
	$start_date = $_POST['date_start'];
	$end_date = $_POST['date_end'];
	$start_time = $_POST['time_start'];
	$end_time = $_POST['time_end'];
	$id_employee = $_POST['id_employee'];
	$interval_time = $_POST['interval_time'];
	$start = $_POST['start'];
	$end = $_POST['end'];

	$current_date = date('Y-m-d'); // Текущая дата

	if ($start_date === '' || $end_date === '' || $start_time === '' || $end_time === '') {
		$fieldsAddSchedule = 'Все поля должны быть заполнены!';
	} elseif (strtotime($start_date) < strtotime($current_date) || strtotime($end_date) < strtotime($current_date)) {
		$fieldsAddSchedule = 'Дата начала и дата окончания не могут быть раньше текущего дня!';
	} else {

		for ($date = strtotime($start_date); $date <= strtotime($end_date); $date = strtotime('+1 day', $date)) {
			$work_date = date('Y-m-d', $date);

			// Создание или обновление расписания
			createOrUpdateEmployeeSchedule($id_employee, $work_date, $start_time, $end_time);

			// Генерация временных слотов с интервалом
			$slots = generateHourlySlots($start_time, $end_time, $interval_time);

			// Создание записей
			createAppointments($id_employee, $work_date, $slots);
		}
		$fieldsAddSchedule = '';

		$employee = selectOne('employees', ['id' => $id_employee]);
		$schedules = getEmployeeScheduleForWeek($employee['id'], $start, $end);
	}
}
