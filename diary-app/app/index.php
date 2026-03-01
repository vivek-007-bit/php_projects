<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /login.php");
    exit();
}

include "../partials/_dbconnect.php";

//fetching all the notes from the db



//add a new note
if (isset($_POST['add_entry'])) {
    $username = $_SESSION['username'];
    $title = $_POST['insertNoteTitle'];
    $description = $_POST['insertNoteDescription'];

    $sql = "INSERT INTO entries (username, title, description) VALUES ('$username', '$title', '$description')";

    $result = mysqli_query($conn, $sql);
    //echo"note added successfully";
    
    // Redirect to same page to prevent resubmission
    header("Location: /app/");
    exit();
}

    //update a note 
    if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE entries 
            SET title='$title', description='$description'
            WHERE id='$id'";

    mysqli_query($conn, $sql);

    header("Location: /app/");
    exit();
    }


//delete a note 
if (isset($_POST['delete_id'])) {

    $delete_id = $_POST['delete_id'];
    $username = $_SESSION['username'];

    $delete_sql = "DELETE FROM entries WHERE id = '$delete_id' AND username = '$username'";
    $result = mysqli_query($conn, $delete_sql);
    //echo"note deleted successfully";

    // Redirect to prevent resubmission
    header("Location: /app/");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome: <?php echo $_SESSION['name']; ?> </title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">


</head>

<body>

    <!-- Add a note Modal -->
    <div class="modal fade" id="addnote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add An Entry</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="insertNoteTitle" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="insertNoteDescription" rows="13"
                                    required></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_entry" class="btn btn-success">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VIEW MODAL -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="viewModalDate"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" id="viewTitle" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="viewDescription" class="form-control" rows="8" readonly></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- EDIT MODAL -->
    <div class="modal fade" id="editmodal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Edit Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form method="POST">
            <div class="modal-body">

            <!-- hidden id -->
            <input type="hidden" name="id" id="editId">

            <div class="mb-3">
                <label>Title</label>
                <input type="text" class="form-control" name="title" id="editTitle">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea class="form-control" name="description" id="editDescription" rows="6"></textarea>
            </div>

            </div>

            <div class="modal-footer">
            <button type="submit" name="update" class="btn btn-primary">
                Save Changes
            </button>
            </div>
        </form>

        </div>
    </div>
    </div>


    <div class="outer-body">
        <div class="app-box">
            <div class="app-left">
                <button class="btn btn-dark bg-gray btn-lg" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions"
                    aria-controls="offcanvasWithBothOptions">&Congruent;</button>

                <div class="offcanvas text-bg-dark bg-dark offcanvas-start" data-bs-scroll="true" tabindex="-1"
                    id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h1 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                            <img src="../assets/favicon.png" class="logo">
                            MyDiary
                        </h1>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" style="background-color: rgb(165, 248, 252);">
                        <ul class="sidebar-links">
                            <li><h3 style="color: black;">Welcome:
                            <?php echo $_SESSION['name']; ?></h3></li>
                            <li><small class="text-muted"><?php echo $_SESSION['username']; ?></small></li>
                            <li><a href="logout.php" style="text-decoration: none; color: red;">Logout</a></li>
                            <li><a href="/contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="app-right">

                <div class="app-top d-flex">
                        <ul>
                            <li>
                                <img src="../assets/favicon.png" class="logo">
                                <input type="search" name="searchBar" placeholder="Search an Entry" id="searchBar">
                            </li>
                        </ul>
                </div>

                
        <div class="app-notes-container">

        <?php
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM entries WHERE username='$username' ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0):
            while ($note = mysqli_fetch_assoc($result)):
        ?>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($note['title']); ?></h5>

                <p class="card-text">
                    <?php
                        $desc = strip_tags($note['description']);
                        if (strlen($desc) > 30) {
                            echo htmlspecialchars(substr($desc, 0, 25)) . '...';
                        } else {
                            echo htmlspecialchars($desc);
                        }
                    ?>
                </p>

                <small class="text-muted">
                    <?php echo date("d/m/Y", strtotime($note['created_at'])); ?>
                </small>
                <br><br>

                <button class="btn btn-primary view-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#viewModal"
                    data-title="<?php echo htmlspecialchars($note['title'], ENT_QUOTES); ?>"
                    data-description="<?php echo htmlspecialchars($note['description'], ENT_QUOTES); ?>"
                    data-created-at="<?php echo htmlspecialchars(date('d/m/Y', strtotime($note['created_at'])), ENT_QUOTES); ?>">
                    View
                </button>

                <button class="btn btn-primary edit-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#editmodal"
                    data-id="<?php echo $note['id']; ?>"
                    data-title="<?php echo htmlspecialchars($note['title'], ENT_QUOTES); ?>"
                    data-description="<?php echo htmlspecialchars($note['description'], ENT_QUOTES); ?>">
                    Edit
                </button>
                
                <form method="POST" action="" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $note['id']; ?>">
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this note?');">
                            Delete
                        </button>
                </form>

            </div>
        </div>

        <?php endwhile; else: ?>
            <p class="text-center">No notes found.</p>
        <?php endif; ?>

        </div>

                <div class="app-bottom">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#addnote">
                        Add An Entry
                    </button>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

        <script src="script.js"></script>
</body>


</html>











