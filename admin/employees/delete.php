<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_emp_id'])) {
    $employee_id = $_GET['del_emp_id'];
    $brend_id = $user['brend_id'];
    $deleteUser = findUserById($employee_id);

    // Начало транзакции
    $pdo->beginTransaction();

    try {
        // Удаление из таблицы appointments
        $sql = "DELETE FROM appointments WHERE employee_id = :employee_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();

        // Удаление из таблицы employee_schedules
        $sql = "DELETE FROM employee_schedules WHERE employee_id = :employee_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();

        // Удаление из таблицы employee_services
        $sql = "DELETE FROM employee_services WHERE employee_id = :employee_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();

        // Удаление из таблицы online_bookings
        $sql = "DELETE FROM online_bookings WHERE employee_id = :employee_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();

        // Удаление сотрудника из таблицы employees
        $sql = "DELETE FROM employees WHERE id = :employee_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();

        // Подтверждение транзакции
        $pdo->commit();

        // Перенаправление после успешного удаления
        header('Location: ' . BASE_URL . 'admin-employees.php');
        exit();
    } catch (Exception $e) {
        // Откат транзакции в случае ошибки
        $pdo->rollBack();
        throw $e;
    }
}

