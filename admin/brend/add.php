<?php 

$erroMessagePosotions = '';
$successMessPosotions = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_position'])) {
    global $pdo;
    $brend_id = $_POST['brend_id'];
    $position_id = $_POST['position'];

    // formatEnter($_POST);

    // Проверка и очистка данных
    $brend_id = filter_var($brend_id, FILTER_VALIDATE_INT);
    $position_id = filter_var($position_id, FILTER_VALIDATE_INT);

    if ($brend_id && $position_id) {
        // Проверка, что позиция существует в таблице positions
        $position = selectOne('positions', ['id' => $position_id]);
        if ($position) {
            // Проверка, что такая запись ещё не существует
            $existingEntry = selectOne('brand_positions', ['brend_id' => $brend_id, 'position_id' => $position_id]);
            if (!$existingEntry) {
                // Добавление записи в таблицу brand_positions
                insert('brand_positions', ['brend_id' => $brend_id, 'position_id' => $position_id]);
                $successMessPosotions = 'Должность успешно добавлена для бренда.';
            } else {
                $erroMessagePosotions = 'Эта должность уже существует для данного бренда.';
            }
        } else {
            $erroMessagePosotions = 'Выбранная должность не существует.';
        }
    } else {
        $erroMessagePosotions = 'Некорректные данные.';
    }
}