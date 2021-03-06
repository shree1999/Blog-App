<?php
  require_once("Includes/DB.php");
?>
<?php
  require_once("Includes/Functions.php");
?>
<?php
  require_once("Includes/sessions.php")
?>
<?php
$_SESSION['trackingUrl'] = $_SERVER["PHP_SELF"];

confirm_login(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">

    <script src="https://kit.fontawesome.com/d5a041e6b5.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <!-- Navbar -->
    <div style="height:10px; background-color: #27aae1;"></div>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container">
        <a href="#" class="navbar-brand">CMS Blog</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="Dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="posts.php" class="nav-link">Posts</a>
            </li>
            <li class="nav-item">
              <a href="categories.php" class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
              <a href="admins.php" class="nav-link">Manage Admins</a>
            </li>
            <li class="nav-item">
              <a href="comments.php" class="nav-link">Comments</a>
            </li>
            <li class="nav-item">
              <a href="blog.php?page=1" class="nav-link">Live Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="logout.php" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div style="height:10px; background-color: #27aae1;"></div>
    <!-- End of Navbar -->

    <!-- Header -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-2">
            <h1><i class="fas fa-blog" style="color: #27aae1"></i>Blog Posts</h1>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="addnewposts.php" class="btn btn-primary btn-block">
              <i class="fas fa-edit"></i> Add New Post
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="categories.php" class="btn btn-info btn-block">
              <i class="fas fa-folder-plus"></i> Add New Categories
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="admins.php" class="btn btn-warning btn-block">
              <i class="fas fa-user-plus"></i> Add New Admin
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="comments.php" class="btn btn-success btn-block">
              <i class="fas fa-check"></i> Approve Comments
            </a>
          </div>
        </div>
      </div>
    </header>
    <!--End of Header-->

    <!-- Main Area -->

    <section class="container py-2 mb-4">
        <div class="row">
          <div class="col-lg-12">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();

             ?>
            <table class="table table-striped table-hover">
              <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date&Time</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Action</th>
                <th>Live Preview</th>
              </tr>
            </thead>
              <?php
                  global $connectionDB;
                  $sql = "SELECT * FROM posts";
                  $stmt = $connectingDB->query($sql);
                  $sr = 0;
                  while ($dataRows = $stmt->fetch()) {
                    $id        = $dataRows["id"];
                    $dateTime  = $dataRows["datetime"];
                    $postTitle = $dataRows["title"];
                    $category  = $dataRows["category"];
                    $admin     = $dataRows["author"];
                    $image     = $dataRows["image"];
                    $postText  = $dataRows["post"];
                    $sr++;
               ?>
               <tbody>
               <tr>
                 <td><?php echo $sr; ?></td>
                 <td>
                   <?php if (strlen($postTitle) > 20) {
                     $postTitle = substr($postTitle, 0, 15)."...";

                   }
                        echo $postTitle;
                   ?>
                   </td>
                 <td><?php echo $category; ?></td>
                 <td>
                   <?php if (strlen($dateTime) > 5) {
                   $dateTime = substr($dateTime, 0, 5)."...";

                 }
                  echo $dateTime;
                 ?></td>
                 <td>
                   <?php if (strlen($admin) > 7) {
                   $admin = substr($admin, 0, 7)."...";
                 }
                 echo $admin;
                 ?></td>
                 <td>
                   <img src="Uploads/<?php echo $image; ?>" alt="image" height="50px" width="170px">
                   </td>
                 <td>
                   <a href="EditPost.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
                   <a href="DeletePost.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                 </td>
                 <td>
                   <a href="FullPost.php?id=<?php echo $id; ?>" class="btn btn-primary"  target="_blank">Live Preview</a>
                 </td>
               </tr>
      <?php } ?>

            </tbody>

            </table>
          </div>
        </div>
    </section>
    <!-- End of main -->
    <!-- Footer -->
    <div class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="lead text-center small">The Content-Management-Blog By Shreeansh Gupta and Sangam Prasad in <span id="year"></span></p>
          </div>
        </div>
      </div>
    </div>
    <div style="height:10px; background-color: #27aae1;"></div>
    <!-- EndFooter -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>
