<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoloader

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Set up PHPMailer object
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output. Set to 0 to disable.
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.example.com'; // Specify SMTP server
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'your_username'; // SMTP username
    $mail->Password = 'your_password'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('contact@dgbtek.com', 'To Name'); // Add a recipient

    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New form submission';
    $mail->Body    = "Name: $name <br> Email: $email <br> Message: $message";

    // Send email
    $mail->send();
    echo 'Message has been sent';

  } catch (Exception $e) {
    echo 'Message could not be sent. Error: ', $mail->ErrorInfo;
  }
}
?>
