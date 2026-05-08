<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-6.9.1/src/Exception.php';
require 'PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer-6.9.1/src/SMTP.php';

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "farrelanka0403@gmail.com";

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email content.
        $email_content = "First Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Subject: $subject\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'farrelanka0403@gmail.com'; // SMTP username
            $mail->Password   = 'aosw oztz ccqv sbqb'; // SMTP password (use app password for Gmail)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port       = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($recipient); // Add a recipient

            // Content
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = $subject;
            $mail->Body    = $email_content;

            $mail->send();
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } catch (Exception $e) {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
