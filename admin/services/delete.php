<?php

function deleteService($table, $condition)
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE ";

    // Create SQL query dynamically based on the condition array
    $whereClauses = [];
    foreach ($condition as $column => $value) {
        $whereClauses[] = "$column = :$column";
    }
    $sql .= implode(' AND ', $whereClauses);

    $stmt = $pdo->prepare($sql);
    foreach ($condition as $column => $value) {
        $stmt->bindValue(":$column", $value);
    }

    return $stmt->execute();
}

// Check if the GET request contains 'del_service_id' and 'brand_id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_service_id']) && isset($_GET['brend_id'])) {
    $service_id = $_GET['del_service_id'];
    $brend_id = $_GET['brend_id'];

      $condition = [
        'service_id' => $service_id,
        'brend_id' => $brend_id
    ];

    deleteService('brand_services', $condition);
    header('Location: ' . BASE_URL . 'admin-services.php?sort=' . $_GET['sort']);
}
