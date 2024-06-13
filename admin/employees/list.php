<?php
function formatDateToDayMonth($date)
{
	$months = [
		'01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
		'05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
		'09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
	];

	$day = date('d', strtotime($date));
	$month = date('m', strtotime($date));

	return $day . ' ' . $months[$month];
}
$months = [
	'01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
	'05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
	'09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
];

function selectAllEmployeesWithPositions($brend_id, $position_id = null)
{
    global $pdo;

    $sql = "
        SELECT e.*, p.name AS position_name
        FROM employees e
        JOIN positions p ON e.position_id = p.id
        WHERE e.brend_id = :brend_id
    ";

    if ($position_id !== null) {
        $sql .= " AND e.position_id = :position_id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);

    if ($position_id !== null) {
        $stmt->bindParam(':position_id', $position_id, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_service_from_emp'])) {
  global $pdo;
  $id = $_GET['del_service_from_emp'];
  $sql = "DELETE FROM `employee_services` WHERE service_id = $id";
  $response = $pdo->prepare($sql);
  $response->execute();
  dbCheckError($response);
  header('Location: ' . BASE_URL . 'admin-services.php');
}


if (empty(!$_GET['date'])) {

	$currentDate = date('Y-m-d', strtotime($_GET['date']));
	if (!empty($_GET['employee_id'])) {
		$_SESSION['employee_id'] = ['id' => $_GET['employee_id']];
		$employee = selectOne('employees', $_SESSION['employee_id']);
	} else {
		$_SESSION['employee_id'] = '';
	}

	$employees = selectAll('employees', ['brend_id' => $user['brend_id']]);
} else {

	$currentDate = date('Y-m-d');
	if ($_GET['position_id']) {
		$employees = selectAllEmployeesWithPositions($user['brend_id'], $_GET['position_id']);
		unset($_SESSION['employee_id']);
	} else {

		if (!empty($_GET['employee_id'])) {
			$_SESSION['employee_id'] = ['id' => $_GET['employee_id']];
			$employee = selectOne('employees', $_SESSION['employee_id']);

		} else {
			$_SESSION['employee_id'] = '';

		}
		$employees = selectAllEmployeesWithPositions($user['brend_id']);
    // formatEnter($employees);
	}
}

$start_date = $currentDate; // Начало текущей недели
$end_date = date('Y-m-d', strtotime($currentDate . ' +7 days')); // Конец текущей недели
$schedules = getEmployeeScheduleForWeek($employee['id'], $start_date, $end_date);
