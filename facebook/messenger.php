<?php
    session_start();
    include "partials/_dbconnect.php";
    $user = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger:
        <?php echo  $user ?>
    </title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/messenger.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">

    <style>

    </style>
</head>

<body style="padding-top: 70px;">

<?php include "partials/_nav2.php"; ?>
<div class="alert alert-danger" role="alert">
  site under development
</div>

<div class="container-fluid box">
    <!-- Contact List -->
    <div class="card contact-list">

        <div class="card-header">
            <form class="d-flex" role="search">
                <input 
                    class="form-control me-2" 
                    type="search" 
                    placeholder="Search" 
                    aria-label="Search" 
                />
            </form>
        </div>

        <!-- Populating the contacts in the form of cards -->
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">

                <div class="col-md-4">
                    <img 
                        src="/facebook/assets/profile.svg"
                        class="img-fluid rounded-start"
                        alt="profile pic"
                    >
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">_vivek_sharma_</h5>

                        <p class="card-text">
                            4+ messages
                        </p>

                        <p class="card-text">
                            <small class="text-body-secondary">
                                Last Seen 3 mins ago
                            </small>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Chats Container -->
    <div class="card chats-container">

        <h5 class="card-header p-2 bg-primary">
            Messenger
        </h5>

        <div class="card-body">

            <h5 class="card-title"></h5>

            <p class="card-text messages">
                Chats goes here
            </p>

            <div class="card-header p-2">
                <form class="d-flex me-2" role="search">

                    <input 
                        class="form-control me-2"
                        type="search"
                        placeholder="Send Message..."
                        aria-label="Search"
                        required
                    >

                    <button 
                        class="btn btn-outline-success"
                        type="submit"
                    >
                        Send
                    </button>

                </form>
            </div>

        </div>

    </div>

</div>
```


    <script src="libs/bootstrap.js"></script>
</body>
</html>