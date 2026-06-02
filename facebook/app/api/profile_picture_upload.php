<?php

    use Cloudinary\Api\Upload\UploadApi;
    include "cloudinary_config.php";
    
    session_start();
    include "../../config/db_connect.php";

    if(!isset($_SESSION['username'])){
        die("User not logged in");
    }

    $username = $_SESSION['username'];


        if(isset($_FILES['profile_pic'])){

            $file_tmp = $_FILES['profile_pic']['tmp_name'];

            $upload = (new UploadApi())->upload($file_tmp, [
                "folder" => "facebook/profile_pics",
                "quality" => "auto",
                "fetch_format" => "auto"
            ]);

            $image_url = $upload['secure_url'];

        

        // verify user exists
        $check = "SELECT username FROM users WHERE username='$username'";
        $res = mysqli_query($conn,$check);

        if(mysqli_num_rows($res) == 0){
            die("User not found in database");
        }

        // insert post
        $sql = "UPDATE users SET profile_pic='$image_url' WHERE username='$username'";

        if(mysqli_query($conn,$sql)){
            header("Location: ../profile.php");
            exit();
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    }
?>