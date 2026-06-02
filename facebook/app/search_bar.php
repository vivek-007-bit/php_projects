<?php

     session_start();
     $name = $_SESSION['name'];
     $username = $_SESSION['username'];

     include "../config/db_connect.php";

     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
         header("location: ../auth/login.php");
         exit();
     }

     $search_query = $_GET['searchBar'];

    //return 5 matching users 
     $search_users = " ";

     $search_users_sql = "SELECT name, username, profile_pic FROM `users` WHERE name LIKE '%$search_query%' OR username LIKE '%$search_query%' LIMIT 5";
     $search_users_result = mysqli_query($conn, $search_users_sql);

     if ( $search_users_result && mysqli_num_rows( $search_users_result) > 0){
        while ($row = mysqli_fetch_assoc( $search_users_result)){

        $profile_pic = $row['profile_pic'];
        $username = $row['username'];

        $search_users .= '<div style="width: 300px">
                            <a href="profile.php?user_id='.$username.'" style="text-decoration: none; ">
                                <button type="button" class="btn btn-light users">
                                    <img class="profile-pics" src=" '.$profile_pic.' " alt=" '.$username.' profile picture"> '.$username.' 
                                </button>
                            </a>
                          </div>';
        }
    }

    else{
    $search_users = "<h4>No users found!</h4><br>";
    }

    //return 5 matching posts 
     $search_posts = " ";

     $search_posts_sql = "SELECT * FROM `posts` WHERE caption LIKE '%$search_query%' ORDER BY RAND()";
     $search_posts_result = mysqli_query($conn, $search_posts_sql);

     if ($search_posts_result && mysqli_num_rows($search_posts_result) > 0){
         while ($row2 = mysqli_fetch_assoc($search_posts_result)){

         $img_path = $row2['img_path'];
         $caption = $row2['caption'];
         $created_at = date("d M Y", strtotime($row2['created_at']));
         $username = $row2['username'];

         $search_posts .= '<div class="card" style="cursor: pointer; border: none;">
                 <img src="'.$img_path.'" class="card-img searched-post"  data-caption="'.$caption.'"  data-date="'.$created_at.'" data-user="'.$username.'">
             </div>';
         }
     }

     else{
     $search_posts = "<h4>No posts found!</h4>";
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../fav-icon.png" type="image">
    
    <link rel="stylesheet" href="../app/assets/libs/bootstrap.css">
    <link rel="stylesheet" href="../app/assets/css/search_bar.css">
    
    <title>Welcome: <?php echo $name;?></title>
</head>
<body style="margin-top:80px;">


<!--Modal for viewing the posts-->
<div class="modal fade" id="postPreviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 modalUserName" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card mb-3">
            <img src="..." class="card-img-top" id="post-src" alt="..." width="auto">
            <div class="card-body">

            </div>
          </div>
        </div>
        <div class="modal-footer" style="justify-content: left; display: flex; flex-direction: row; align-items: center;">
            <h5 class="card-title" id="post-date"></h5>
            <h5 class="card-title" id="post-caption"></h5>
        </div>
      </div>
    </div>
  </div>

    <?php include "api/navbar.php"; ?>
    <div class="wrapper">

        <div class="serach-users">
            <?php echo $search_users;?>
        </div>

        <div class="search-posts">
            <?php echo $search_posts;?>
        </div>
    </div>

    <script src="../app/assets/libs/bootstrap.js"></script>
    <script src="../app/assets/js/search_bar.js"></script>
</body>
</html>


