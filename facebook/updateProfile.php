<?php
    session_start();
    $user = $_SESSION['name'];
    include "partials/_getUserDetails.php";

        if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "partials/_dbconnect.php";



        $profileImage = $_FILES["profileImage"]["name"];
        $bgImage = $_FILES["bgImage"]["name"];
        $fullName = $_POST["fullName"];
        $username = $_POST["username"];
        $bio = $_POST["bio"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $MobileNumber = $_POST["MobileNumber"];
        $homeTown = $_POST["homeTown"];

        //image upload
        $tmp=explode(".",$profileImage);

        $newfilename = round(microtime(true)).'.'.end($tmp);

        $uploadpath="uploads/".$newfilename;

        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadpath);



        //inserting in database
        $sql = "UPDATE `users` SET `profile_pic` = '$newfilename', `bg_pic` = '$bgImage', `bio` = '$bio', `DOB` = '$dob', `gender` = '$gender', `mobileNumber` = '$MobileNumber', `homeTown` = '$homeTown' WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        header("location: myprofile.php");
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile:
        <?php echo  $_SESSION['name'] ?>
    </title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>
    <?php include "partials/_nav.php"; ?>

    <div class="container mt-4">
        <form class="container border border-dark my-5 rounded p-5" style="width: 450px; max-width: 70vw;" method="post" enctype="multipart/form-data">
        <h3 class="mb-4">Update Your Profile</h3>
        <div class="mb-3">
            <label for="profileImage" class="form-label fw-bold">Select Profile Image</label>
            <input class="form-control" type="file" id="profileImage" name="profileImage" value="<?php echo $CurrentprofilePic;?>" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="bgImage" class="form-label fw-bold">Select Background Image</label>
            <input class="form-control" type="file" id="bgImage" name="bgImage" accept="image/*" value="<?php echo $CurrentbgPic;?>">
        </div>
        <div class="mb-3">
            <label for="Full Name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $CurrentName;?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" id="username" name="username"
                value="<?php echo $CurrentUsername?>" readonly>
        </div>
        <div class="mb-3">
            <label for="Bio" class="form-label">Bio/About Me</label>
            <textarea class="form-control" id="bio" name="bio" rows="4" maxlength="255"><?php echo $Currentbio;?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Select Gender</label>
            <div class="d-flex gap-3">

                <!-- Male Option -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if($CurrentGender == "Male") echo "checked";?> required>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>

                <!-- Female Option -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if($CurrentGender == "Female") echo "checked";?> >
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>

                <!-- Other Option -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="Others" <?php if($CurrentGender == "Other") echo "checked";?>>
                    <label class="form-check-label" for="other">
                        Other
                    </label>
                </div>

            </div>

        </div>
        <div class="mb-3">
            <label for="dob" class="form-label fw-bold">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $CurrentDOB;?>" required>
        </div>
        <div class="mb-3">
            <label for="MobileNumber"  class="form-label">Mobile Number</label>
            <input type="tel" class="form-control" id="MobileNumber" name="MobileNumber" Value="<?php echo $CurrentMobileNumber;?>" placeholder="Enter your Mobile Number" required>
        </div>
        <div class="mb-3">
            <label for="homeTown" class="form-label">Home Town</label>
            <input type="text" class="form-control" id="homeTown" name="homeTown" placeholder="Home Town" Value="<?php echo $CurrentHomeTown;?>">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>
    </div>

    <script src="libs/bootstrap.js"></script>
</body>


</html>