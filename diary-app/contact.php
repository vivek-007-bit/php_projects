<?php

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






