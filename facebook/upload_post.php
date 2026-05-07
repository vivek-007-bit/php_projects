<?php
    
    use Cloudinary\Api\Upload\UploadApi;

    include "configure_cloudinary.php";
    
    session_start();
    include "partials/_dbconnect.php";

    if(!isset($_SESSION['username'])){
        die("User not logged in");
    }

    $username = $_SESSION['username'];
    $caption = $_POST['caption'];


        if(isset($_FILES['posts_img'])){

            $file_tmp = $_FILES['posts_img']['tmp_name'];

            $upload = (new UploadApi())->upload($file_tmp, [
                "folder" => "uploads/posts",
                "quality" => "auto",
                "fetch_format" => "auto"
            ]);

            $image_url = $upload['secure_url'];

        }

        // verify user exists
        $check = "SELECT username FROM users WHERE username='$username'";
        $res = mysqli_query($conn,$check);

        if(mysqli_num_rows($res) == 0){
            die("User not found in database");
        }

        // insert post
        $sql = "INSERT INTO posts (username, img_path, caption) VALUES ('$username', '$image_url', '$caption')";

        if(mysqli_query($conn,$sql)){
            header("Location: profile.php");
            exit();
        } else {
            echo "Database error: " . mysqli_error($conn);
        }

?>