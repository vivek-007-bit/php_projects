<?php

     session_start();
     include "../config/db_connect.php";

     $name = $_SESSION['name'];
     $username = $_SESSION['username'];

     $_SESSION['user_id'] = '';

     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
         header("location: ../auth/login.php");
         exit();
     }


     //shared post 
     $gateway = "/facebook";

     $shared_post = "";
    if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    $share_link_sql = "SELECT *  FROM `posts` WHERE `id` = '$post_id' ";
    $share_link_result = mysqli_query($conn, $share_link_sql);

    if(mysqli_num_rows($share_link_result) > 0){
        while($share_link_row = mysqli_fetch_assoc($share_link_result)){
                $shared_post= '
                                    <div class="suggested-posts">
                                        <div class="header">
                                        <a href=" profile.php?user_id='.$share_link_row['username'].'">
                                            <img src="" class="user-profile-pic">
                                            <b> '.$share_link_row['username'].'</b>
                                        </a>
                                        </div>

                                        <img src=" '.$share_link_row['img_path'].' " alt=" '.$share_link_row['username'].' post" class="posts-img">

                                        <div class="caption">
                                            '.date("d M Y", strtotime($share_link_row['created_at'])).' <span></span>
                                            '.$share_link_row['caption'].' <br>
                                               <button class="btn btn-light share-post-btn" data-bs-toggle="modal" data-bs-target="#sharePostModal" style="width: 100px;" data-link=" '.$gateway.'/app/home.php?post_id='.$share_link_row['id'].' ">
                                               Share
                                               </button>
                                        </div>
                                    </div>';
        }

        } 
        else{
        $shared_post= '<div class="alert alert-danger w-100 text-center"  style="grid-column: 1 / -1; margin-top: 30px;" role="alert">
                            Post Unavailable 
                        </div>';
        }
    }


     //fetch 10 latest posts
     $suggested_posts = "";
     $suggested_users = "";

     if (!isset($_GET['post_id'])) {

        $suggested_posts_sql = "SELECT * FROM posts WHERE username!= '$username' ORDER BY RAND() LIMIT 10"; 
        $suggested_posts_result = mysqli_query($conn, $suggested_posts_sql);
   
        if(mysqli_num_rows($suggested_posts_result) > 0){
           while($suggested_posts_row = mysqli_fetch_assoc($suggested_posts_result)){
                   $suggested_posts.= '
                                       <div class="suggested-posts">
                                       
                                           <div class="header">
                                           <a href=" profile.php?user_id='.$suggested_posts_row['username'].'">
                                               <img src="" class="user-profile-pic">
                                               <b> '.$suggested_posts_row['username'].'</b>
                                           </a>
                                           <button type="button" class="btn btn-primary">Follow</button>
                                           </div>
   
                                           <img src=" '.$suggested_posts_row['img_path'].' " alt=" '.$suggested_posts_row['username'].' post" class="posts-img">
   
                                           <div class="caption">
                                               '.date("d M Y", strtotime($suggested_posts_row['created_at'])).' <span></span>
                                               '.$suggested_posts_row['caption'].' <br>

                                            <div class="footer">
                                               <button class="btn btn-light like-post-btn">
                                                    <img src="assets/images/like.svg">
                                                    Like
                                               </button>

                                                
                                               <button class="btn btn-light comment-btn" data-bs-toggle="modal" data-bs-target="#commentsModal" >
                                                    <img src="assets/images/comment.svg">
                                                    Comments
                                               </button>

                                               <button class="btn btn-light share-post-btn" data-bs-toggle="modal" data-bs-target="#sharePostModal"  data-link=" '.$gateway.'/app/home.php?post_id='.$suggested_posts_row['id'].' ">
                                                    <img src="assets/images/share.svg">
                                                    Share
                                               </button>
                                               </div>

                                           </div>
                                       </div>';
           }
   
        } 
        else{
           $suggested_posts.= '<div class="alert alert-light w-100 text-center"  style="grid-column: 1 / -1; margin-top: 30px;" role="alert">
                               No Latest Posts 
                           </div>';
        }

        $suggested_users_sql = "SELECT * FROM users WHERE username != '$username' ORDER BY RAND() LIMIT 7";
        $suggested_users_result = mysqli_query($conn, $suggested_users_sql);
   
        if(mysqli_num_rows($suggested_users_result) > 0){
           while($suggested_users_row = mysqli_fetch_assoc($suggested_users_result)){
                   $suggested_users.= '<a href="profile.php?user_id=' .$suggested_users_row['username'].' ">
                                       <img src=" '.$suggested_users_row['profile_pic'].' " alt=" '.$suggested_users_row['username'].' " class="suggested-users-pic">
                                           '.$suggested_users_row['name'].'
                                       </a>';
           }
        } 
     }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../fav-icon.png" type="image">

    <link rel="stylesheet" href="../app/assets/libs/bootstrap.css">
    <link rel="stylesheet" href="../app/assets/css/home_feed.css">

    <title>Welcome:
        <?php echo $name;?>
    </title>
</head>

<body>


<!--Modal for sharing the posts-->
<div class="modal fade" id="sharePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 modalUserName" id="exampleModalLabel">Share Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="share-post-url" style="color:rgb(55, 83, 244); padding:30px 20px;">
        </div>
        <div class="modal-footer">
            <div id="copy-btn-text" style="margin-right: 30px; color: green;"></div>
            <button class="btn btn-primary" id="modal-copy-link">Copy Link</button>
        </div>
      </div>
    </div>
  </div>


<!--Modal for viewing the comments-->
<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 modalUserName" id="exampleModalLabel">Comments</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


    <?php include "api/navbar.php"; ?>

    <div class="wrapper">

        <?php echo $shared_post; ?>
        
        <?php echo $suggested_posts ?>

        <div class="suggested-users">
            <?php echo $suggested_users ?>
        </div>

        <?php echo $suggested_posts ?>

        <div class="suggested-users">
            <?php echo $suggested_users ?>
        </div>

        <div class="endless-scroll">
            
        </div>

    </div>

    <script src="../app/assets/libs/bootstrap.js"></script>
    <script src="../app/assets/js/home_feed.js"></script>
</body>

</html>
