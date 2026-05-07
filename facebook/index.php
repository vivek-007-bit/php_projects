<?php
    include "partials/_dbconnect.php";
    session_start();
    
    $name = $_SESSION['name'];
    $username = $_SESSION['username'];

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
        header("location: login.php");
        exit;
    }


//fetching the posts
    $suggested_posts = "";
    $posts_sql = "SELECT * FROM `posts` LIMIT 10";
    $result = mysqli_query($conn, $posts_sql);

    while ($row = mysqli_fetch_assoc($result)){
        $name = $row['username'];
        $img_path = $row['img_path'];
        $caption = $row['caption'];
        $created_at = $row['created_at'];

        $suggested_posts .= '<div class="card mb-3" style="max-width="450px">
                        <img class="card-img-top" src=" '.$img_path.' " alt="Card image cap" width="450px" height="400px">
                        <div class="card-body">
                            <h5 class="card-title"> '.$name.' </h5>
                            <p class="card-text"> '.$caption.' </p>
                            <p class="card-text"><small class="text-muted"> '.$created_at.' </small></p>
                        </div>
                    </div>';
    }

//fetching the users
    $suggested_users = "";
    $users_sql = "SELECT * FROM `users` LIMIT 10";
    $result2 = mysqli_query($conn, $users_sql);

    while ($row = mysqli_fetch_assoc($result2)){
        $username = $row['username'];
        $profile_pic = $row['profile_pic'];

        $suggested_users .= '<div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="'.$profile_pic.'" class="img-fluid rounded-start" alt="profile-pic">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"> '.$username.'</h5>
                        </div>
                        </div>
                    </div>
                    </div>';
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome: <?php echo  $name; ?></title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>
    <?php include "partials/_nav2.php"; ?>

    <div class="container" style="margin-top: 100px;">
    <?php 
          echo "<h4>Suggested Posts</h4>". $suggested_posts;
          echo"<br>";
          echo "<h4>Suggested Users</h4>". $suggested_users; 
          
    ?>

    </div>
    <script src="libs/bootstrap.js"></script>
</body>


</html>