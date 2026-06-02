<?php
     
     session_start();

     include "../config/db_connect.php";

     $name = $_SESSION['name'];
     $username = $_SESSION['username'];

     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("location: ../auth/login.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $current_user_dp = $row['profile_pic'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../fav-icon.png" type="image">
    <link rel="stylesheet" href="../app/assets/libs/bootstrap.css">
    <link rel="stylesheet" href="../app/assets/css/messenger.css">
    <title>Messenger:
        <?php echo  $username;?>
    </title>
</head>

<body>
    <?php include "api/navbar.php"; ?>

    <div class="wrapper">
        <div class="left">
            <input type="text" name="" id="searchbar" placeholder="Search">
            <div class="contact-list">

            <?php
                $contacts_query = "SELECT * FROM users WHERE username != '$username' ORDER BY id";
                $contacts_result = mysqli_query($conn, $contacts_query);

                if(mysqli_num_rows($contacts_result) > 0){
                        while($row = mysqli_fetch_assoc($contacts_result)){

                                $contact_username = $row['username'];
                                $contact_user_dp = $row['profile_pic'];

                                echo '<button type="button" class="btn btn-light contacts" data-user="'.$contact_username.'" data-profilePic=" '.$contact_user_dp.' ">
                                          <img class="profile-pics" src=" '.$contact_user_dp.' " alt=" '.$contact_username.' profile picture"> '.$contact_username.' 
                                      </button>';

                        }
                }
            ?>
            </div>
        </div>
        <div class="right">
            <div class="header">
                <img class="profile-pics" id="user-profile-pic"
                    src=" <?php echo $current_user_dp; ?> ">
                <h3 id="header-name">Welcome</h3>
            </div>
            <div class="chats">
            </div>
            <div class="footer">
                <input type="text" class="input-message" placeholder="Type a message.">
                <button class="send-message">Send</button>
            </div>
        </div>
    </div>

<script src="../app/assets/libs/bootstrap.js"></script>
<script src="../app/assets/js/messenger.js"></script>
</body>

</html>