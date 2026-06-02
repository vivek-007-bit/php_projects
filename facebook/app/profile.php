<?php
     
     session_start();
     include "../config/db_connect.php";

     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("location: ../auth/login.php");
        exit();
    }

    $name = "";
    $username = "";

    if(isset($_GET['user_id'])){

        $username = $_GET['user_id'];
    }

    else{

        $name = $_SESSION['name'];
        $username = $_SESSION['username'];
    }


    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $bio = $row['bio'];
    $dp = $row['profile_pic'];


    if(isset($_POST['update_bio'])){
        $bioUpdate = $_POST['bioUpdate'];

        $update_bio_sql = " UPDATE users SET bio = '$bioUpdate' WHERE username = '$username' ";
        $update_bio_result = mysqli_query($conn, $update_bio_sql);

        if($update_bio_result){
            header("Location: profile.php");
            exit();
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../fav-icon.png" type="image">

    <link rel="stylesheet" href="assets/libs/bootstrap.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    
    <link rel="stylesheet" href="assets/libs/photoswipe-dynamic-caption-plugin.css">
    <title>Profile:
        <?php echo  $username;?>
    </title>
</head>

<body>


    <!--modal for uploading the posts-->
    <div class="modal fade" id="createPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="api/posts_upload.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="imageInput" name="posts_img" required>
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>

                        <br><br>

                        <img id="preview" src=""
                            style="max-width:300px; display:none; border-radius:10px; border: solid black 2px; margin: auto;" />

                        <div class="form-floating" id="caption" style="display: none; margin-top: 20px;">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                                rows="5" maxlength="100" name="caption"></textarea>
                            <label for="floatingTextarea">Add a Caption</label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="upload_post">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal For updating the profile picture-->
    <div class="modal fade" id="updateProfilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Profile Picture</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="api/profile_picture_upload.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="profileImageInput" name="profile_pic" required>
              <label class="input-group-text" for="inputGroupFile02">Profile Picture</label>
            </div>

            <br><br>

            <img id="profileImagePreview" src="" style="max-width:300px; aspect-ratio:1/1; display:none; border-radius:50%; border: solid black 2px; margin: auto;" />

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="update-profile-form">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<!--Modal For Updating the bio-->
    <div class="modal fade" id="updateBioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Bio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div id="caption">
                            <textarea class="form-control" rows="5" maxlength="150" name="bioUpdate" style="height: 200px; text-align: left;"><?php echo $bio; ?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="update_bio">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!--Modal for previewing the posts-->
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
        
        <div class="header">

           <div style=" display: flex; flex-direction: column; gap: 10px; align-items: center;">
                <img src="<?php echo $dp; ?>" alt="profile-pic" class="profile-pic">

                <?php 
                    if(!isset($_GET['user_id'])){
                                echo '<button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#updateProfilePic" style="width: 50%;">Edit</button>';
                            }
                    ?>
            </div>


            <div class="row">
                <h1><?php echo  $name;?></h1>
                <h5><?php echo  $username;?></h5>

                <div style="display: flex; flex-direction: column;">
                    <textarea name="user-bio" id="user-bio" placeholder="<?php echo $bio;?>" readonly></textarea>

                    <?php 
                    if(!isset($_GET['user_id'])){
                        echo '<button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#updateBioModal" style="width: 40%;">Edit</button>';
                    }
                    ?>
                </div>

            </div>

            <?php 
                    if(!isset($_GET['user_id'])){
                        echo '<button class="btn btn-light create-post" data-bs-toggle="modal" data-bs-target="#createPostModal">
                                    <img src="assets/images/upload.svg" alt="Upload">Create Post
                              </button>';
                    }
                    ?>
        </div>

        <div class="image-gallery">

            <?php  
                $posts_sql = "SELECT * FROM posts WHERE username='$username' ORDER BY created_at DESC";
                $posts_result = mysqli_query($conn, $posts_sql);

                if(mysqli_num_rows($posts_result) > 0 ){
                    while($row = mysqli_fetch_assoc($posts_result)){

                        $img = $row['img_path'];
                        $caption = $row['caption'];
                        $date = date("d M Y", strtotime($row['created_at']));

                        echo '
                              <img src=" '.$img.' " alt="posts" data-username=" '.$username.' " data-caption=" '.$caption.' " data-date=" '.$date.' " data-bs-toggle="modal" data-bs-target="#postPreviewModal">';
                    }
                }  

                else{
                    if(!isset($_GET['user_id'])){
                        echo '<div class="alert alert-light w-100 text-center"   style="grid-column: 1 / -1;" role="alert">
                                No posts yet. Create your first post
                              </div>';
                    }

                    else {
                        echo '<div class="alert alert-light w-100 text-center"   style="grid-column: 1 / -1;" role="alert">
                                No posts yet.
                              </div>';
                    }
                } 
            ?>

        </div>
    </div>

    <script src="assets/libs/bootstrap.js"></script>
    <script type="module" src="assets/js/profile.js"></script>
</body>

</html>


