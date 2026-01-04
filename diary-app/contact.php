<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg   = $_POST['query'];

    // Load PHPMailer classes
    require __DIR__ . '/PHPMailer/PHPMailer.php';
    require __DIR__ . '/PHPMailer/SMTP.php';
    require __DIR__ . '/PHPMailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('MAIL_USERNAME'); // Render ENV
        $mail->Password   = getenv('MAIL_PASSWORD'); // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Email headers
        $mail->setFrom(getenv('MAIL_USERNAME'), 'Contact Form');
        $mail->addAddress(getenv('MAIL_USERNAME'), 'Diary-App');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email From Diary-App';
        $mail->Body    = "
            <strong>Sender Name:</strong> {$name}<br><br>
            <strong>Sender Email:</strong> {$email}<br><br>
            <strong>Message:</strong><br>{$msg}
        ";

        $mail->send();

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Email sent successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>';

    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email could not be sent.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">


</head>
<body>
<?php include "partials/_nav.php"; ?>
    <div class="box">
        <form method="post" class="form" id="contactForm">
            <h1>Contact Us</h1>
            <label for="email" class="mb-3">Name
                <input type="text" name="name" id="name" placeholder="Type your Name" required>
            </label>
            <label for="email" class="mb-3">Email
                <input type="text" name="email" id="email" placeholder="Type your Email" required>
            </label>
            <div class="form-group">
                <label for="query">Your Query</label>
                <textarea class="form-control" id="query" name="query" rows="8"
                    placeholder="...Your query goes here..."></textarea>
            </div>
            <button class="btn">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</body>


</html>



