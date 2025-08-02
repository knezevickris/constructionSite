<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/php-email-form/src/PHPMailer.php';
require '../assets/vendor/php-email-form/src/SMTP.php';
require '../assets/vendor/php-email-form/src/Exception.php';

$mail = new PHPMailer(true);

try {
    // SMTP konfiguracija
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'testnigradjevinac@gmail.com';      // <-- zameni
    $mail->Password   = 'quxi xwxw liby szdz';  // <-- zameni
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Podaci iz forme
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Primaoci
    $mail->setFrom($email, $name);
    $mail->addAddress('kristinaknezevic06@gmail.com', 'VB Inzenjering');

    // Sadržaj
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = nl2br($message);

    $mail->send();
    echo 'Poruka je uspješno poslana.';
} catch (Exception $e) {
    echo "Došlo je do greške: {$mail->ErrorInfo}";
}
