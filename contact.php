<?php
// Include PHPMailer classes
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $project = htmlspecialchars($_POST['project']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug = 0;                                 // Disable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'usmankicsit2021@gmail.com';             // SMTP username
        $mail->Password = 'lqim uzof yqbt trzi';              // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('usmankicsit2021@gmail.com', 'Mailer');
        $mail->addAddress('usmankicsit2018@gmail.com', 'Usman'); // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "<h2>Contact Form Submission</h2>
                          <p><strong>Name:</strong> {$name}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Project:</strong> {$project}</p>
                          <p><strong>Message:</strong><br>{$message}</p>";
        $mail->AltBody = "Name: {$name}\nEmail: {$email}\nProject: {$project}\nMessage: {$message}";

        $mail->send();
        echo 'Thank you for contacting us!';
    } catch (Exception $e) {
        echo "Sorry, something went wrong. Please try again later. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
