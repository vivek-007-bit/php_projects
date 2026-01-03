<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['query'];

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'viveksharma40649@gmail.com';                     //SMTP username
    $mail->Password   = 'teqd istf ljrs fchl';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('viveksharma40649@gmail.com', 'Contact Form');
    $mail->addAddress('viveksharma40649@gmail.com', 'Diary-App');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email From Diary-App';
    $mail->Body    = "Sender Name - $name <br> Sender Email - $email <br> Message - $msg";

    $mail->send();
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Email has been sent <strong>Successfully</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
} catch (Exception $e) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Error.</strong> Email Couldnot be sent
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

    <link rel="stylesheet" href="/diary-app/css/style.css">
    <link rel="stylesheet" href="/diary-app/css/responsive.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="shortcut icon" href="/diary-app/assets/favicon.png" type="image/x-icon">


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