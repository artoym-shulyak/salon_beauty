<?php
function getEmployeesBrend($table, $conditions)
{
    global $pdo;

    // Построение SQL-запроса
    $sql = "SELECT e.*, p.name AS position_name 
            FROM employees e
            JOIN positions p ON e.position_id = p.id";

    // Добавление условий в запрос
    $whereClauses = [];
    $params = [];
    foreach ($conditions as $key => $value) {
        $whereClauses[] = "$key = :$key";
        $params[$key] = $value;
    }

    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam(":$key", $val);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServiceByBrandAndService($brend_id, $service_id)
{
    global $pdo;

    // SQL-запрос для получения данных об услуге конкретного бренда
    $sql = "
        SELECT s.name, bs.price, bs.duration
        FROM brand_services bs
        JOIN services s ON bs.service_id = s.id
        WHERE bs.brend_id = :brend_id AND bs.service_id = :service_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
    $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$currentDate = $_GET['date'] ? date('Y-m-d', strtotime($_GET['date'])) : date('Y-m-d');
$start_date = $currentDate;
$end_date = date('Y-m-d', strtotime($currentDate . ' +7 days'));

!empty($_GET['ID_BREND']) ? $_SESSION['ID_BREND'] = $_GET['ID_BREND'] : null;
!empty($_GET['ID_EMPLOYEE']) ? $_SESSION['ID_EMPLOYEE'] = $_GET['ID_EMPLOYEE'] : null;
!empty($_GET['ID_SERVICE']) ? $_SESSION['ID_SERVICE'] = $_GET['ID_SERVICE'] : null;

if (empty($_GET['SELECTED'])) {
  unset($_SESSION['ID_BREND']);
  unset($_SESSION['ID_EMPLOYEE']);
  unset($_SESSION['ID_SERVICE']);
}

if (empty($_GET['SORT'])) {
  $_GET['SORT'] = null;
}


if (!empty($_GET['ID'])) {
  $commentsEmployee = selectAll('comments', [ 'employee_id' => $_GET['ID'], 'status' => 'confirmed' ]);
  $employee = selectOne('employees', [ 'id' => $_GET['ID'] ]);
}


if ($_GET['SELECTED'] === 'EMPLOYEES') {
  $brendEmployees = getEmployeesBrend('employees', ['brend_id' => $_SESSION['ID_BREND']]);
  unset($_SESSION['ID_EMPLOYEE']);
}

if ($_GET['SELECTED'] === 'SERVICES') {
  $servicesEmployee = getServicesByEmployee($_SESSION['ID_EMPLOYEE'], $_GET['SORT']);
  unset($_SESSION['ID_SERVICE']);
}

if ($_GET['SELECTED'] === 'TIME') {
  $schedules = getEmployeeScheduleForWeek($_SESSION['ID_EMPLOYEE'], $start_date, $end_date);
}

if ($_GET['SELECTED'] === 'RESULT') {
  $resultService = getServiceByBrandAndService($_SESSION['ID_BREND'], $_SESSION['ID_SERVICE']);
}

if (!empty($_SESSION['ID_BREND'])) {
  $brend = selectOne('brends', [ 'id' => $_SESSION['ID_BREND'] ]);
  $commentsBrend = selectAll('comments', [ 'brend_id' => $_SESSION['ID_BREND'], 'status' => 'confirmed']);
}  else {
  $brends = selectAll('brends');
}
