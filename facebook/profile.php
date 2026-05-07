<?php
    session_start();
    include "partials/_dbconnect.php";

    // If not logged in, redirect to login page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }

    $name = $_SESSION['name'];
    $username = $_SESSION['username'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row = $result->fetch_assoc();

    $bio = $row['bio'];
    $dp = $row['profile_pic'];

    

    if(isset($_POST['update-profile-form'])){
        $name = $_POST['update-name'];
        $bio = $_POST['update-bio'];

        $sql = "UPDATE users SET name = '$name', bio = '$bio' WHERE username = '$username'";

        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['name'] = $name;
            header("location: profile.php");
            exit();
        }else{
            echo "error" . mysqli_error($conn);
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile:
        <?php echo  $name; ?>
    </title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
    <link rel="stylesheet" href="/facebook/css/index.css">
    <link rel="stylesheet" href="libs/src/css/lightbox.css">

    <script src="libs/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include "partials/_nav2.php"; ?>

    <!-- Modal for editing the profile -->
    <div class="modal fade" id="editProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="update-name" value="<?php echo $name; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Bio</label>
                            <textarea class="form-control" aria-label="With textarea" rows="8" name="update-bio"
                                maxlength="150"
                                placeholder="Describe About Yourself"><?php echo htmlspecialchars($bio); ?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-profile-form">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!--modal for updating profile picture-->
  <div class="modal fade" id="updateProfilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Profile Picture</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="profileimageInput" name="profile_pic" required>
              <label class="input-group-text" for="inputGroupFile02">Profile Picture</label>
            </div>

            <br><br>

            <img id="profilePreview" src="" style="max-width:300px; aspect-ratio:1/1; display:none; border-radius:50%; border: solid black 2px; margin: auto;" />

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="update-profile-form">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

    <div class="container" style="margin-top: 80px;">
        <div class="container col-xxl-8 px-4">
            <div class="row flex-lg-row align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="<?php echo $dp; ?>" class="d-block mx-lg-auto img-fluid profile-pic"
                        alt="profile-pic" width="500" height="500" loading="lazy" style="cursor: pointer; aspect-ratio:1/1;">
                        <button type="button" class="btn btn-light d-block my-2" style="margin: auto;" data-bs-toggle="modal" data-bs-target="#updateProfilePic">Edit</button>
                </div>
                <div class="col-lg-6">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start my-2">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Follow</button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Message</button>
                    </div>

                    <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">
                        <?php echo $name; ?>
                    </h1>
                    <p class="lead profile-desc">
                        <?php echo $bio; ?>

                    </p>
                    <div class="d-grid gap-4">
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#editProfile">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-2 my-5 text-center border-bottom border-top">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
            </div>
        </div>

        <div class="grid-container px-5 my-5 text-center border-bottom">
            <?php
                $sql = "SELECT * FROM posts WHERE username='$username' ORDER BY created_at DESC";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_assoc($result)){
                        $img = $row['img_path'];

                        $date =  date("jS M Y", strtotime($row['created_at']));
                        $caption = $row['caption'];

                        $title = $date . "  " . $caption;


                        
                        echo '<div class="grid-item">
                                <a href="'.$img.'" data-lightbox="mygallery" data-title="'.$title.'">
                                    <img src="'.$img.'" alt="Photo 1" />
                                </a>
                                </div>';

                    }

                }else{
                    echo '<div class="alert alert-light w-100 text-center"  style="grid-column: 1 / -1;" role="alert">
                            No posts yet. Create your first post
                        </div>';

                }
            ?>
        </div>

    </div>

    <script src="libs/bootstrap.js"></script>
</body>

<script>
  document.getElementById("profileimageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const preview = document.getElementById("profilePreview");
        preview.src = e.target.result;
        preview.style.display = "block";
      }
      reader.readAsDataURL(file);
    }
  });
</script>

<script src="libs/src/js/lightbox.js"></script>

<script>
    lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'fadeDuration': 300,
    'imageFadeDuration': 300
    })
</script>


</html>