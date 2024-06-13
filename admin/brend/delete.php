<?php

function deleteBrandPosition($position_id, $brend_id ) {
    global $pdo;

    $sql = "DELETE FROM brand_positions WHERE position_id = :position_id AND brend_id = :brend_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':position_id', $position_id, PDO::PARAM_INT);
    $stmt->bindParam(':brend_id', $brend_id, PDO::PARAM_INT);
    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_brenPos'])) {
    $position_id = filter_var($_GET['id_brenPos'], FILTER_VALIDATE_INT);
    $brend_id = filter_var($_GET['brend_id'], FILTER_VALIDATE_INT);

    // formatEnter($_GET);

    if ($position_id && $brend_id) {
        deleteBrandPosition($position_id, $brend_id);
    }
}