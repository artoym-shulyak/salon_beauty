<?php


function sendConfirmationEmail($to, $name, $booking_date, $booking_time) {
  $months = [
  '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
  '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
  '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
  ];
    $day = date('d', strtotime($booking_date));
    $month = date('m', strtotime($booking_date));

    $subject = "Подтверждение записи";
    $message = "Уважаемый(ая) $name,\n\nВаша запись на " . $day . ' ' . $months[$month] . " в " . date('H:i', strtotime($booking_time)) . " подтверждена.\n\nАдрес: г. Гродно, улица Ожешко 22.\nМы с нетерпением ждем вашего визита!\n\nСпасибо за использование наших услуг!";
    $headers = "From: salon_beaty@sempai-frl.ru\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['take_online'])) {
    $booking = selectOneBookingWithClient($_GET['take_online']);
    $name = $booking['client_name'];
    $email = $booking['client_email'];
    $booking_date = $booking['booking_date'];
    $booking_time = $booking['booking_time'];

    if (sendConfirmationEmail($email, $name, $booking_date, $booking_time)) {
        update('appointments', $booking['employee_id'], ["status" => 'confirmed']);
        update('online_bookings', $booking['id'], ["status" => 'confirmed']);
    } else {
      echo 'Сообщение не было отпправлено';
    }
}
?>


 