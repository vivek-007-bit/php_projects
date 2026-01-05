<?php
    session_start();
    include "partials/_dbconnect.php";
    $user = $_SESSION['name'];

    include "partials/_getUserDetails.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile:
        <?php echo  $_SESSION['name'] ?>
    </title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
    <style>
        .cover-photo {
            width: 100%;
            height: 220px;
            position: relative;
            background-color: rgba(0, 0, 0, 0);
            border: solid black 2px;
            border-radius: 10px;
        }

        .cover-photo .box {
            background-color: rgba(0, 0, 0, 0.342);
            height: 100%;
            width: 100%;
            border-radius: 10px;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
        }

        .bg-pic {
            height: inherit;
            border-radius: 10px;
            width: 100%;
            position: relative;
        }

        .photo-section {
            background-color: rgba(0, 0, 0, 0);
            position: absolute;
            bottom: 0;
            display: flex;
            justify-content: space-between;
            align-items: self-end;
            flex-direction: row;
            width: 100%;
            padding: 0 15px;
            z-index: 10;
        }

        .profile-pic {
            border-radius: 50%;
            height: 120px;
            width: 120px;
            box-shadow: 5px 5px 5px 10px rgba(2, 2, 2, 0.462);
            margin-bottom: 10px;

        }
    </style>
</head>

<body>
    <?php include "partials/_nav.php"; ?>

    <div class="container mt-2 ">
        <!-- Cover and Profile -->
        <div class="cover-photo">
            <div class="box"></div>
            <img src="/facebook/uploads/1753624698.webp" alt="Cover Picture" class="bg-pic">
            <div class="photo-section">
                <img src="/facebook/uploads/<?php echo $CurrentprofilePic; ?>" alt="Profile Picture" class="profile-pic"
                    onclick="">
                <h3><a class="btn btn-outline-success" href="/facebook/updateProfile.php"><b>Edit Profile</b></a></h3>
            </div>
        </div>


        <!-- Profile Name & Tabs -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="profile-name">
                        <?php echo $CurrentName; ?>
                    </h2>

                    <p class="profile-name">
                        <?php echo $Currentbio; ?>
                    </p>
                    <ul class="nav nav-tabs mt-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Photos</a>
                        </li>
                    </ul>

                    <!-- Posts Section -->
                    <div class="card card-post mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Post Title</h5>
                            <p class="card-text">This is a post content from the user.</p>
                        </div>
                    </div>

                    <div class="card card-post mb-4 mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Another Post</h5>
                            <p class="card-text">Here goes the content of another post.</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: About Section -->
                <div class="col-md-4">
                    <div class="card mt-4">
                        <div class="card-header">About Me</div>
                        <div class="card-body">
                            <p><strong>Mobile Number:</strong>
                                <?php echo $CurrentMobileNumber; ?>
                            </p>
                            <p><strong>Location:</strong>
                                <?php echo $CurrentHomeTown; ?>
                            </p>
                            <p><strong>Date Of Birth:</strong>
                                <?php echo $CurrentDOB; ?>
                            </p>
                            <p><strong>Gender:</strong>
                                <?php echo $CurrentGender; ?>
                            </p>
                        </div>
                    </div>


                </div>

                <script src="libs/bootstrap.js"></script>
</body>


</html>