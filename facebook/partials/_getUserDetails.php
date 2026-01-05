<?php
    include "partials/_dbconnect.php";

    $sql = "SELECT * FROM users where full_name = '$user'";  
        $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Output each row
        while ($row = mysqli_fetch_assoc($result)) {
            $CurrentName = $row["full_name"];
            $CurrentUsername =  $row["username"];
            $CurrentprofilePic =  $row["profile_pic"];
            $CurrentbgPic = $row["bg_pic"];
            $Currentbio = $row["bio"];
            $CurrentGender =  $row["gender"];
            $CurrentDOB = $row["DOB"];
            $CurrentMobileNumber = $row["mobileNumber"];
            $CurrentHomeTown = $row["homeTown"];
        }
    }
?>