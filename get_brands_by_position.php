<?php
session_start();
include 'helpers/path.php';
include('routes/request.php');

if (isset($_GET['position_id'])) {
    $position_id = filter_var($_GET['position_id'], FILTER_VALIDATE_INT);

    if ($position_id) {
        $sql = "SELECT b.id, b.name 
                FROM brends b
                JOIN brand_positions bp ON b.id = bp.brend_id
                WHERE bp.position_id = :position_id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':position_id', $position_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($brands);
    }
}
?>
