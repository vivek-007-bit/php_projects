<?php
    session_start();

    $searchResult_users = " ";
    $searchResult_posts = " ";

    $username = $_SESSION['username'];

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
        header("location: login.php");
        exit;
    }

    
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        include "partials/_dbconnect.php";

        $searchBar = $_GET['searchBar'];

        //return  10 maching users
        $sql = "SELECT name, username, profile_pic FROM `users` WHERE name LIKE '%$searchBar%' OR username LIKE '%$searchBar%' LIMIT 10";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){

            $profile_pic = $row['profile_pic'];
            $name = $row['name'];
            $username = $row['username'];

            $searchResult_users .= '<div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="'.$profile_pic.'" class="img-fluid rounded-start" alt="profile-pic">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Name: '.$name.'</h5>
                        <p class="card-text">UserName: '.$username.'</p>
                    </div>
                    </div>
                </div>
                </div>';
            }
        }

        else{
        $searchResult_users = "<h4>No users found!</h4><br>";
    }

        $sql2 = "SELECT * FROM `posts` WHERE caption LIKE '%$searchBar%'";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2 && mysqli_num_rows($result2) > 0){
            while ($row2 = mysqli_fetch_assoc($result2)){

            $username = $row2['username'];
            $img_path = $row2['img_path'];
            $caption = $row2['caption'];
            $created_at = $row2['created_at'];

            $searchResult_posts .= '<div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="'.$img_path.'" class="img-fluid rounded-start" alt="profile-pic">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Name: '.$username.'</h5>
                        <p class="card-text">UserName: '.$caption.'</p>                       
                        <p class="card-text">'.$created_at.'</p>
                    </div>
                    </div>
                </div>
                </div>';
            }
        }

        else{
        $searchResult_posts = "<h4>No posts found!</h4>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo  "Search: ". $searchBar; ?></title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body style="padding-top:100px; padding-left: 50px;">
    <?php
        include "partials/_nav2.php";
    ?>

    <?php
        echo $searchResult_users;
    ?>

    <?php
        echo $searchResult_posts;
    ?>

    <script src="libs/bootstrap.js"></script>
</body>