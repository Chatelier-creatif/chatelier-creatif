<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-fr.securemail.pro';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@lechatelier-creatif.fr';
        $mail->Password   = 'cucqut-tuhby8'; // mot de passe mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('contact@lechatelier-creatif.fr', "Le Cha'Telier Créatif");
        $mail->addAddress('contact@lechatelier-creatif.fr');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "Nouveau message depuis le site";
        $mail->Body    = "
            <strong>Nom :</strong> {$name}<br>
            <strong>Email :</strong> {$email}<br><br>
            <strong>Message :</strong><br>{$message}
        ";

        $mail->send();
        header("Location: merci.html");
        exit();

    } catch (Exception $e) {
        echo "Erreur d'envoi : {$mail->ErrorInfo}";
    }
}
