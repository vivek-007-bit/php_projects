<?php

echo '<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-bottom border-dark">
  <div class="container-fluid">

    <img src="../fav-icon.png" alt="Fb-logo"
      width="37" height="35"
      style="margin-left: 20px; cursor: pointer;">

    <button class="navbar-toggler" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav align-items-center">

        <li class="nav-item" style="margin-left: 10px;">
          <a class="btn btn-light mx-2 nav-btns" href="home.php">
            <img src="assets/images/home.svg"
              alt="Home">
              Home
          </a>
        </li>

        <li class="nav-item">
          <a class="btn btn-light mx-2 nav-btns" href="profile.php">
            <img src="assets/images/profile.svg"
              alt="Profile">
              Profile
          </a>
        </li>

        <li class="nav-item">
          <a class="btn btn-light mx-2 nav-btns" href="messenger.php">
            <img src="assets/images/messenger.svg"
              alt="Messenger">
              Messenger
          </a>
        </li>

        <li class="nav-item">
          <a class="btn btn-light mx-2 nav-btns" href="notifications.php">
            <img src="assets/images/notifications.svg"
              alt="Notifications">
              Notifications
          </a>
        </li>

      </ul>

      <div class="d-flex ms-auto align-items-center">

        <form class="d-flex me-2"
          role="search"
          action="search_bar.php"
          method="get">

          <input class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
            name="searchBar"
            required>

          <button class="btn btn-outline-dark" type="submit">
            Search
          </button>
        </form>

        <a class="btn btn-outline-danger"
          href="../auth/logout.php"
          style="margin-right: 10px;">

          Log Out
        </a>

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
  <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
</body>
</html>