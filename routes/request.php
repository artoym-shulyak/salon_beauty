<?php
include('helpers/connect.php');

global $pdo;

// Fun -> Форматирование текста
function formatEnter($value)
{
  echo '<pre>';
  print_r($value);
  echo '</pre>';
  exit();
}

// Fun -> Выявления ошибки
function dbCheckError($response)
{
  // Создаем объект для поиск ошибок...
  $errInfo = $response->errorInfo();

  if ($errInfo[0] !== PDO::ERR_NONE) {
    echo $errInfo[2];
    exit();
  }

  return true;
}

// Fun -> Запрос данных некоторой таблицы
function selectAll($table, $params = [])
{
  global $pdo;

  // Сформировываем запрос...
  $sql = "SELECT * FROM $table";

  if (!empty($params)) {
    $i = 0;
    foreach ($params as $key => $value) {
      // Проверка тип значения...
      if (!is_numeric($value)) {
        $value = "'" . $value . "'";
      }

      if ($i === 0) {
        $sql = $sql . " WHERE $key = $value";
      } else {
        $sql = $sql . " AND $key = $value";
      }
      $i++;
    }
  }

  // Подготавливаем запрос...
  $response = $pdo->prepare($sql);
  // Получаем данные...
  $response->execute();

  // Проверка ошибок...
  dbCheckError($response);

  return $response->fetchAll();
}

// Fun -> Запрос одной строки таблицы
function selectOne($table, $params = [])
{
  global $pdo;

  // Сформировываем запрос...
  $sql = "SELECT * FROM $table";

  if (!empty($params)) {
    $i = 0;
    foreach ($params as $key => $value) {
      // Проверка тип значения...
      if (!is_numeric($value)) {
        $value = "'" . $value . "'";
      }

      if ($i === 0) {
        $sql = $sql . " WHERE $key = $value";
      } else {
        $sql = $sql . " AND $key = $value";
      }
      $i++;
    }
  }

  // Подготавливаем запрос...
  $response = $pdo->prepare($sql);
  // Получаем данные...
  $response->execute();

  // Проверка ошибок...
  dbCheckError($response);

  return $response->fetch();
}

// Fun -> Запись в таблицу
function insert($table, $params)
{
  global $pdo;

  $i = 0;
  // Свойства
  $coll = '';
  // Значения
  $mask = '';



  // Формируем параметры к запросам...
  foreach ($params as $key => $value) {
    // Проверка тип значения...
    if (!is_numeric($value)) {
      $value = '"' . $value . '"';
    }

    if ($i === 0) {
      $coll = $coll . $key;
      $mask = $mask . $value;
    } else {
      $coll = $coll . ", " . $key;
      $mask = $mask . ", " . $value;
    }

    $i++;
  }


  // Сформировываем запрос...
  $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

  // Подготавливаем запрос...
  $response = $pdo->prepare($sql);
  // Получаем данные...
  $response->execute($params);
  // Проверка ошибок...
  dbCheckError($response);

  return $pdo->lastInsertId();
}

// Fun -> Обновление одной строки таблицы
function update($table, $id, $params)
{
  global $pdo;

  $i = 0;
  // Свойства
  $str = '';

  // Формируем параметры к запросам...
  foreach ($params as $key => $value) {
    // Проверка тип значения...
    if (!is_numeric($value)) {
      $value = "'" . $value . "'";
    }

    if ($i === 0) {
      $str = $str . $key . '=' . $value;
    } else {
      $str = $str . ', ' . $key . '=' . $value;
    }

    $i++;
  }

  // Сформировываем запрос...
  $sql = "UPDATE $table SET $str WHERE id = $id";

  // Подготавливаем запрос...
  $response = $pdo->prepare($sql);
  // Получаем данные...
  $response->execute($params);
  // Проверка ошибок...
  dbCheckError($response);
}

// Fun -> Удаление одной строки таблицы
function delete($table, $id)
{
  global $pdo;

  // Сформировываем запрос...
  $sql = "DELETE FROM $table WHERE id = $id";

  // Подготавливаем запрос...
  $response = $pdo->prepare($sql);
  // Получаем данные...
  $response->execute();
  // Проверка ошибок...
  dbCheckError($response);
}

function getEmployeeSchedule($employee_id, $date)
{
  global $pdo;

  $sql = "
    SELECT e.id, e.name, e.post, es.work_date, es.time_start, es.time_end, es.break_time_start, es.break_time_end
    FROM employees e
    JOIN employee_schedules es ON e.id = es.employee_id
    WHERE e.id = :employee_id AND es.work_date = :date
    ORDER BY es.time_start
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
  $stmt->bindParam(':date', $date, PDO::PARAM_STR);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Получение записей сотрудников на неделею
function getEmployeeScheduleForWeek($employee_id, $start_date, $end_date)
{
  global $pdo;

  $sql = "
  SELECT es.employee_id, es.work_date, es.start_time, es.end_time, a.appointment_time, a.status
  FROM employee_schedules es
  LEFT JOIN appointments a ON es.employee_id = a.employee_id 
  AND es.work_date = a.appointment_date
  JOIN employees e ON es.employee_id = e.id
  WHERE e.id = :employee_id
  AND es.work_date BETWEEN :start_date AND :end_date
  ORDER BY es.work_date
	";

  $response = $pdo->prepare($sql);
  $response->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
  $response->bindParam(':start_date', $start_date, PDO::PARAM_STR);
  $response->bindParam(':end_date', $end_date, PDO::PARAM_STR);
  $response->execute();

  return $response->fetchAll(PDO::FETCH_ASSOC);
}

// Получение записей на конретный день сотрудника
function getAppointments($employee_id, $date)
{
  global $pdo;

  $sql = "
			SELECT *
			FROM appointments
			WHERE employee_id = :employee_id
			AND appointment_date = :date
      AND status = 'free'
	";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
  $stmt->bindParam(':date', $date, PDO::PARAM_STR);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// function getServicesByEmployee($employee_id, $service_type)
// {
//   global $pdo;

//   $sql = "
// 			SELECT s.*
// 			FROM services s
// 			JOIN employee_services es ON s.id = es.service_id
// 			WHERE es.employee_id = :employee_id
// 	";

//   $response = $pdo->prepare($sql);
//   $response->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
//   $response->execute();

//   return $response->fetchAll(PDO::FETCH_ASSOC);
// }

// function getServicesByEmployee($employee_id, $service_type = null)
// {
//     global $pdo;

//     // Подготовить SQL-запрос для извлечения данных
//     $sql = "SELECT s.*
//             FROM services s
//             JOIN employee_services es ON s.id = es.service_id
//             WHERE es.employee_id = :employee_id";
    
//     // Если передан тип услуги, добавьте условие WHERE для фильтрации по типу
//     if ($service_type !== null) {
//         $sql .= " AND s.type = :service_type";
//     }

//     // Подготовить запрос к базе данных
//     $stmt = $pdo->prepare($sql);

//     // Привязать параметр сотрудника к запросу
//     $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);

//     // Если передан тип услуги, привязать его параметр к запросу
//     if ($service_type !== null) {
//         $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
//     }

//     // Выполнить запрос
//     $stmt->execute();

//     // Вернуть результаты запроса в виде массива ассоциативных массивов
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function getServicesByEmployee($employee_id, $service_type = null)
{
    global $pdo;

    // Подготовить SQL-запрос для извлечения данных
    $sql = "
        SELECT s.*, bs.duration, bs.price
        FROM services s
        JOIN employee_services es ON s.id = es.service_id
        JOIN brand_services bs ON s.id = bs.service_id
        JOIN employees e ON es.employee_id = e.id
        WHERE es.employee_id = :employee_id
          AND e.brend_id = bs.brend_id";

    // Если передан тип услуги, добавьте условие WHERE для фильтрации по типу
    if ($service_type !== null) {
        $sql .= " AND s.type = :service_type";
    }

    // Подготовить запрос к базе данных
    $stmt = $pdo->prepare($sql);

    // Привязать параметр сотрудника к запросу
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);

    // Если передан тип услуги, привязать его параметр к запросу
    if ($service_type !== null) {
        $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
    }

    // Выполнить запрос
    $stmt->execute();

    // Вернуть результаты запроса в виде массива ассоциативных массивов
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





function findUserById($id)
{
    global $pdo;

    // Обновленный SQL-запрос для получения всех столбцов, включая название бренда и позицию
    $sql = "
        SELECT 
            'employee' AS user_type, 
            e.id, 
            e.email, 
            e.password, 
            e.name, 
            e.phone, 
            e.description, 
            e.brend_id, 
            e.position_id, 
            b.name AS brend_name, 
            p.name AS position_name
        FROM 
            employees e
        LEFT JOIN 
            brends b ON e.brend_id = b.id
        LEFT JOIN 
            positions p ON e.position_id = p.id
        WHERE 
            e.id = :id

        UNION

        SELECT 
            'client' AS user_type, 
            c.id, 
            c.email, 
            c.password, 
            c.name, 
            c.phone, 
            c.description, 
            NULL AS brend_id, 
            c.position_id, 
            NULL AS brend_name, 
            NULL AS position_name
        FROM 
            clients c
        WHERE 
            c.id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Функция для генерации временных слотов с интервалом в 1 час
function generateHourlySlots($start_time, $end_time, $interval = 60)
{
  $slots = [];
  $current_time = strtotime($start_time);
  $end_time = strtotime($end_time);

  while ($current_time < $end_time) {
    $slots[] = date('H:i:s', $current_time);
    $current_time = strtotime("+$interval minutes", $current_time);
  }

  return $slots;
}


function createOrUpdateEmployeeSchedule($employee_id, $work_date, $start_time, $end_time)
{
  global $pdo;

  // Проверить, существует ли расписание на этот день
  $sqlCheck = "
      SELECT COUNT(*) 
      FROM employee_schedules 
      WHERE employee_id = :employee_id 
      AND work_date = :work_date
  ";

  $stmtCheck = $pdo->prepare($sqlCheck);
  $stmtCheck->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
  $stmtCheck->bindParam(':work_date', $work_date, PDO::PARAM_STR);
  $stmtCheck->execute();
  $count = $stmtCheck->fetchColumn();

  if ($count > 0) {
    // Обновить расписание
    $sqlUpdate = "
          UPDATE employee_schedules 
          SET start_time = :start_time, end_time = :end_time 
          WHERE employee_id = :employee_id 
          AND work_date = :work_date
      ";

    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':work_date', $work_date, PDO::PARAM_STR);
    $stmtUpdate->execute();
  } else {
    // Создать расписание
    $sqlInsert = "
          INSERT INTO employee_schedules (employee_id, work_date, start_time, end_time)
          VALUES (:employee_id, :work_date, :start_time, :end_time)
      ";

    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmtInsert->bindParam(':work_date', $work_date, PDO::PARAM_STR);
    $stmtInsert->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $stmtInsert->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $stmtInsert->execute();
  }

  // Удалить существующие записи на этот день
  $sqlDelete = "
      DELETE FROM appointments 
      WHERE employee_id = :employee_id 
      AND appointment_date = :appointment_date
  ";

  $stmtDelete = $pdo->prepare($sqlDelete);
  $stmtDelete->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
  $stmtDelete->bindParam(':appointment_date', $work_date, PDO::PARAM_STR);
  $stmtDelete->execute();
}



// Функция для создания записей
function createAppointments($employee_id, $work_date, $slots)
{
  global $pdo;

  $sql = "
        INSERT INTO appointments (employee_id, appointment_date, appointment_time)
        VALUES (:employee_id, :appointment_date, :appointment_time)
    ";

  $stmt = $pdo->prepare($sql);
  foreach ($slots as $slot) {
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':appointment_date', $work_date, PDO::PARAM_STR);
    $stmt->bindParam(':appointment_time', $slot, PDO::PARAM_STR);
    $stmt->execute();
  }
}


function getOnlineBookings($employee_id, $start_date, $end_date, $order_by = 'booking_date', $order_dir = 'ASC')
{
  global $pdo;

  // Проверка значений $order_by и $order_dir для предотвращения SQL-инъекций
  $valid_columns = ['booking_date', 'booking_time', 'client_name', 'service_name', 'date_time'];
  if (!in_array($order_by, $valid_columns)) {
    $order_by = 'booking_date';
  }

  $order_dir = strtoupper($order_dir);
  if ($order_dir !== 'ASC' && $order_dir !== 'DESC') {
    $order_dir = 'ASC';
  }

  $sql = "SELECT ob.*, c.name AS client_name, GROUP_CONCAT(s.name SEPARATOR ', ') AS services_name, CONCAT(ob.booking_date, ' ', ob.booking_time) AS date_time
            FROM online_bookings ob
            JOIN clients c ON ob.client_id = c.id
            JOIN appointment_services aps ON ob.id = aps.appointment_id
            JOIN services s ON aps.service_id = s.id
            WHERE ob.employee_id = :employee_id
            AND ob.booking_date BETWEEN :start_date AND :end_date
            GROUP BY ob.id
            ORDER BY $order_by $order_dir";

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Вывод результатов для отладки
    echo "<pre>";
    print_r($results);
    echo "</pre>";

    return $results;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    return [];
  }
}

// ОСТАНОВИЛИСЬ НА ТОМ, ЧТО МЫ ДОЛЖНЫ ВЫВОДИТЬ НАЗВАНИЕ УСЛУГИ, КОТОРЫЕ ПРИНАДЛЖЕТА ЗАПИСИ, ТАК КАК ВЫВОДЯТСЯ ВСЕ УСЛУГИ
function getOnlineBookingsForDay($employee_id, $current_date, $order_by = 'booking_date', $order_dir = 'ASC')
{
    global $pdo;

    // Проверка значений $order_by и $order_dir для предотвращения SQL-инъекций
    $valid_columns = ['booking_date', 'booking_time', 'client_name', 'services_name', 'status', 'duration', 'price'];
    if (!in_array($order_by, $valid_columns)) {
        $order_by = 'booking_date';
    }

    $order_dir = strtoupper($order_dir);
    if ($order_dir !== 'ASC' && $order_dir !== 'DESC') {
        $order_dir = 'ASC';
    }

    $sql = "SELECT 
            ob.id AS booking_id,
            c.name AS client_name,
            c.email AS client_email,
            s.name AS service_name,
            bs.duration AS service_duration,
            bs.price AS service_price,
            ob.booking_date,
            ob.booking_time,
            ob.status
        FROM 
            online_bookings ob
        JOIN 
            clients c ON ob.client_id = c.id
        JOIN 
            appointments a ON ob.id = a.online_booking_id
        JOIN 
            appointment_services ac ON a.id = ac.appointment_id 
        JOIN 
            brand_services bs ON ac.service_id = bs.service_id
        JOIN 
            services s ON bs.service_id = s.id 
        WHERE 
            ob.booking_date = :currentDate 
            AND ob.employee_id = :employeeId
        ORDER BY 
            $order_by $order_dir";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['currentDate' => $current_date, 'employeeId' => $employee_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getOnlineBookingsClients($client_id, $current_date, $order_by = 'booking_date', $order_dir = 'ASC')
{
    global $pdo;

    // Проверка значений $order_by и $order_dir для предотвращения SQL-инъекций
    $valid_columns = ['booking_date', 'booking_time', 'employee_name', 'service_name', 'service_duration', 'service_price', 'status'];
    if (!in_array($order_by, $valid_columns)) {
        $order_by = 'booking_date';
    }

    $order_dir = strtoupper($order_dir);
    if ($order_dir !== 'ASC' && $order_dir !== 'DESC') {
        $order_dir = 'ASC';
    }

    $start_of_week = date('Y-m-d', strtotime('monday this week', strtotime($current_date)));
    $end_of_week = date('Y-m-d', strtotime('sunday this week', strtotime($current_date)));

    $sql = "SELECT 
            ob.id AS booking_id,
            e.name AS employee_name,
            s.name AS service_name,
            bs.duration AS service_duration,
            bs.price AS service_price,
            ob.booking_date,
            ob.booking_time,
            ob.status
        FROM 
            online_bookings ob
        JOIN 
            clients c ON ob.client_id = c.id
        JOIN 
            employees e ON ob.employee_id = e.id
        JOIN 
            appointments a ON ob.id = a.online_booking_id
        JOIN 
            appointment_services ac ON a.id = ac.appointment_id 
        JOIN 
            brand_services bs ON ac.service_id = bs.service_id
        JOIN 
            services s ON ac.service_id = s.id
        WHERE 
            ob.booking_date BETWEEN :startOfWeek AND :endOfWeek
            AND ob.client_id = :clientId
        ORDER BY 
            $order_by $order_dir";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['startOfWeek' => $start_of_week, 'endOfWeek' => $end_of_week, 'clientId' => $client_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getOnlineBookingsEmployees($employee_id, $current_date, $order_by = 'booking_date', $order_dir = 'ASC')
{
    global $pdo;

    // Проверка значений $order_by и $order_dir для предотвращения SQL-инъекций
    $valid_columns = ['booking_date', 'booking_time', 'client_name', 'service_name', 'service_duration', 'service_price', 'status'];
    if (!in_array($order_by, $valid_columns)) {
        $order_by = 'booking_date';
    }

    $order_dir = strtoupper($order_dir);
    if ($order_dir !== 'ASC' && $order_dir !== 'DESC') {
        $order_dir = 'ASC';
    }

    $start_of_week = date('Y-m-d', strtotime('monday this week', strtotime($current_date)));
    $end_of_week = date('Y-m-d', strtotime('sunday this week', strtotime($current_date)));

    $sql = "SELECT 
                ob.id AS booking_id,
                c.name AS client_name,
                e.name AS employee_name,
                s.name AS service_name,
                bs.duration AS service_duration,
                bs.price AS service_price,
                ob.booking_date,
                ob.booking_time,
                ob.status
            FROM 
                online_bookings ob
            JOIN 
                clients c ON ob.client_id = c.id
            JOIN 
                employees e ON ob.employee_id = e.id
            JOIN 
                appointments a ON ob.id = a.online_booking_id
            JOIN 
                appointment_services ac ON a.id = ac.appointment_id 
            JOIN 
                services s ON ac.service_id = s.id
            JOIN 
                brand_services bs ON s.id = bs.service_id AND bs.brend_id = e.brend_id
            WHERE 
                ob.booking_date BETWEEN :startOfWeek AND :endOfWeek
                AND ob.employee_id = :employeeId
            GROUP BY 
                ob.id, c.name, e.name, s.name, bs.duration, bs.price, ob.booking_date, ob.booking_time, ob.status
            ORDER BY 
                $order_by $order_dir";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['startOfWeek' => $start_of_week, 'endOfWeek' => $end_of_week, 'employeeId' => $employee_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





function getEmployeesScheduleForWeek($start_date, $end_date)
{
  global $pdo;

  $sql = "
        SELECT es.employee_id, es.work_date, es.start_time, es.end_time, a.appointment_time, e.name AS employee_name
        FROM employee_schedules es
        LEFT JOIN appointments a ON es.employee_id = a.employee_id AND es.work_date = a.appointment_date
        JOIN employees e ON es.employee_id = e.id
        WHERE es.work_date BETWEEN :start_date AND :end_date
        ORDER BY es.work_date, es.start_time
    ";

  $response = $pdo->prepare($sql);
  $response->bindParam(':start_date', $start_date, PDO::PARAM_STR);
  $response->bindParam(':end_date', $end_date, PDO::PARAM_STR);
  $response->execute();

  return $response->fetchAll(PDO::FETCH_ASSOC);
}

function getAllAppointments($date)
{
  global $pdo;

  $sql = "
        SELECT *
        FROM appointments
        WHERE appointment_date = :date
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':date', $date, PDO::PARAM_STR);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getEmployeeComments($employee_id)
{
  global $pdo;

  $sql = "
        SELECT 
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.employee_id = :employee_id
            AND comments.status = 'confirmed';
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getBrandComments($brend_id)
{
  global $pdo;

  $sql = "
        SELECT 
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.brend_id = :brend_id
            AND comments.status = 'confirmed';
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAllComments()
{
  global $pdo;

  $sql = "
        SELECT 
            comments.id AS comment_id,
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment,
            comments.status,
            'employee' AS comment_type,
            comments.employee_id AS related_id
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.employee_id IS NOT NULL
        
        UNION
        
        SELECT 
            comments.id AS comment_id,
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment,
            comments.status,
            'brand' AS comment_type,
            comments.brend_id AS related_id
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.brend_id IS NOT NULL
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getAllEmployeeComments()
{
  global $pdo;

  $sql = "
        SELECT 
            comments.id AS comment_id,
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment,
            comments.status,
            'employee' AS comment_type,
            comments.employee_id AS related_id
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.employee_id IS NOT NULL
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAllBrandComments()
{
  global $pdo;

  $sql = "
        SELECT 
            comments.id AS comment_id,
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment,
            comments.status,
            comments.brend_id AS related_id
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.brend_id IS NOT NULL
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getClientComments($client_id)
{
  global $pdo;

  $sql = "
        SELECT 
            COALESCE(c.name, comments.guest_name) AS name,
            COALESCE(c.email, comments.guest_email) AS email,
            comments.comment,
            comments.status
        FROM 
            comments
        LEFT JOIN 
            clients c ON comments.client_id = c.id
        WHERE 
            comments.client_id = :client_id
    ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllWithoutAdmin($table, $conditions)
{
  global $pdo;

  $sql = "SELECT * FROM $table WHERE brend = :brend AND position != 'Администратор'";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':brend', $conditions['brend'], PDO::PARAM_STR);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function handleSession($key, $value)
{
  if (!empty($value)) {
    $_SESSION[$key] = $value;
  }
}


function selectOneBookingWithClient($booking_id)
{
    global $pdo;

    $sql = "
        SELECT 
            ob.*, 
            c.name AS client_name, 
            c.email AS client_email 
        FROM 
            online_bookings ob
        LEFT JOIN 
            clients c ON ob.client_id = c.id
        WHERE 
            ob.id = :booking_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getBrandPositions($brend_id) {
    global $pdo;

    $sql = "
        SELECT 
            positions.id,
            positions.name
        FROM 
            brand_positions
        JOIN 
            positions ON brand_positions.position_id = positions.id
        WHERE 
            brand_positions.brend_id = :brend_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBrandPositions_2($brend_id)
{
    global $pdo;

    $sql = "
        SELECT p.id, p.name
        FROM positions p
        JOIN brand_positions bp ON p.id = bp.position_id
        WHERE bp.brend_id = :brend_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServicesBrend($brend_id, $type_service = null) {
    global $pdo;

    // Подготовка SQL запроса с учетом возможности фильтрации по типу услуги
    $sql = "
        SELECT s.id, s.name, s.text, s.type, bs.duration, bs.price
        FROM services s
        JOIN brand_services bs ON s.id = bs.service_id
        WHERE bs.brend_id = :brend_id
    ";

    // Если передан параметр $type_service, добавляем его в условие WHERE для фильтрации по типу услуги
    if ($type_service !== null) {
        $sql .= " AND s.type = :type_service";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
    
    // Если $type_service не равен null, привязываем его к параметру в запросе
    if ($type_service !== null) {
        $stmt->bindParam(':type_service', $type_service, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



