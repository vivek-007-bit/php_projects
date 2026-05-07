<?php
#navbar after login/Signup

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand mr-2" href="/facebook/index.php">
      <img src="assets/image.png" alt="Fb-logo" width="37" height="35">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav align-items-center">

      <li class="nav-item">
        <a class="btn btn-outline-primary mx-2" href="/facebook/index.php">
            <img src="assets/home.svg" alt="Fb-logo" width="37" height="35">
          Home
        </a>
      </li>

      <li class="nav-item">
        <a class="btn btn-outline-primary mx-2" href="/facebook/profile.php">
                <img src="assets/profile.svg" alt="Fb-logo" width="37" height="35">
          My Profile
        </a>
      </li>

      <li class="nav-item">
        <a class="btn btn-outline-primary mx-2" href="/facebook/messenger.php">
                <img src="assets/messenger.svg" alt="Fb-logo" width="37" height="35">
          Messenger
        </a>
      </li>

    </ul>

      <div class="d-flex ms-auto align-items-center">
      
        <a class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#createPostModal">
              <img src="assets/upload.svg" alt="Fb-logo" width="37" height="35">  
          Upload
        </a>
        
        <form class="d-flex me-2" role="search" action="/facebook/handle_search.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchBar" required>
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <a class="btn btn-outline-danger" href="/facebook/logout.php">Log Out</a>

      </div>

    </div>
  </div>
</nav>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome:
    <?php echo  $name; ?>
  </title>
  <link rel="stylesheet" href="libs/bootstrap.css">
  <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>

  <!--modal for uploading the images-->
  <div class="modal fade" id="createPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="upload_post.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="imageInput" name="posts_img" required>
              <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>

            <br><br>

            <img id="preview" src="" style="max-width:300px; display:none; border-radius:10px; border: solid black 2px; margin: auto;" />

            <div class="form-floating" id="caption" style="display: none; margin-top: 20px;">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" rows="5"  maxlength="100" name="caption"></textarea>
              <label for="floatingTextarea">Add a Caption</label>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="update-profile-form">Create</button>
        </div>
        </form>
      </div>
    </div>
  </div>


</body>

<script>
  document.getElementById("imageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const caption = document.getElementById("caption");
        const preview = document.getElementById("preview");
        preview.src = e.target.result;
        preview.style.display = "block";
        caption.style.display = "block";
      }
      reader.readAsDataURL(file);
    }
  });
</script>


</html>