<?php
$fieldsAddService = ['fields' => ''];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $service_id = $_POST['service_id'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $brend_id = $user['brend_id']; 

    // Проверяем наличие записи в таблице brand_services для данной услуги и бренда
    $existing_record = selectOne('brand_services', ['brend_id' => $brend_id, 'service_id' => $service_id]);

    if ($existing_record) {
        // Если запись уже существует, выдаем сообщение об ошибке
        $fieldsAddService['fields'] = 'Эта услуга уже добавлена для вашего бренда.';
    } else {
        // Все поля заполнены, можно добавить запись в таблицу brand_services
        $brand_service = [
            'brend_id' => $brend_id,
            'service_id' => $service_id,
            'price' => $price,
            'duration' => $duration
        ];

        insert('brand_services', $brand_service);
        header('Location: ' . BASE_URL . 'admin-services.php');
    }
}

