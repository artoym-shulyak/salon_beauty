<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_schedule']) && isset($_GET['del_date'])) {
	$employee_id = $_GET['del_schedule'];
	$work_date = $_GET['del_date'];
	$start_date = $_GET['start_date'];
	$end_date = $_GET['end_date'];

	// Удалить расписание сотрудника на конкретный день
	$sqlDeleteSchedule = "
			DELETE FROM employee_schedules 
			WHERE employee_id = :employee_id 
			AND work_date = :work_date
	";
	$stmtDeleteSchedule = $pdo->prepare($sqlDeleteSchedule);
	$stmtDeleteSchedule->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
	$stmtDeleteSchedule->bindParam(':work_date', $work_date, PDO::PARAM_STR);
	$stmtDeleteSchedule->execute();

	// Удалить записи на конкретный день
	$sqlDeleteAppointments = "
			DELETE FROM appointments 
			WHERE employee_id = :employee_id 
			AND appointment_date = :appointment_date
	";
	$stmtDeleteAppointments = $pdo->prepare($sqlDeleteAppointments);
	$stmtDeleteAppointments->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
	$stmtDeleteAppointments->bindParam(':appointment_date', $work_date, PDO::PARAM_STR);
	$stmtDeleteAppointments->execute();

	$employee = selectOne('employees', ['id' => $employee_id]);
	$schedules = getEmployeeScheduleForWeek($employee['id'], $start_date, $end_date);
}
