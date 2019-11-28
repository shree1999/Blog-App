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

 confirm_login(); ?>
 <?php

$searchQuery = $_GET["id"];

  global $connectingDB;
  $sql = "SELECT * FROM posts WHERE id='$searchQuery'";
  $stmt = $connectingDB->query($sql);
  while ($data = $stmt->fetch()) {
    $titleUpdate = $data["title"];
    $categoryUpdate = $data["category"];
    $imageUpdate = $data["image"];
    $postUpdate = $data["post"];

  }

 if (isset($_POST['Submit'])) {
     // delete query...
     global $connectingDB;
     $sql = "DELETE FROM posts WHERE id='$searchQuery'";

     $execute = $connectingDB->query($sql);
     if ($execute) {

       $targetImageDelete = "Uploads/$imageUpdate";
       unlink($targetImageDelete);

       $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
       Redirect_to("posts.php");

     } else {
       $_SESSION["ErrorMessage"] = "Something Went Wrong!!";
       Redirect_to("posts.php");
     }

 }

  ?>

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
          <div class="col-md-12">
            <h1><i class="fas fa-edit" style="color: #27aae1"></i>Delete Post</h1>
          </div>
        </div>
      </div>
    </header>
    <!--End of Header-->

    <!--Main Area-->
    <section class="container py-2 mb-4">
      <div class="row justify-content-center">
        <div class="offset-lg-1 col-lg-10 align-items-center" style="min-height: 360px;">
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
           ?>
          <form class="" action="DeletePost.php?id=<?php echo $searchQuery ?>" method="post" enctype="multipart/form-data">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"><span class="fieldInfo">Category Title: </span></label>
                  <input disabled class="form-control" type="text" id="title" name="PostTitle" placeholder="Type Title Here" value="<?php echo htmlentities($titleUpdate); ?>">
                </div>
                <div class="form-group">
                  <span class="fieldInfo">Existing Categories: </span>
                  <?php echo htmlentities($categoryUpdate); ?>
                  <br>

                </div>
                <div class="form-group">
                  <span class="fieldInfo">Existing Image: </span>
                    <img class="mb-1" src="Uploads/<?php echo $imageUpdate ?>" alt="" height="70px" width="170px">

                </div>
                <div class="form-group">
                  <label for="Post"><span class="fieldInfo"> Post: </span></label>
                  <textarea disabled name="PostDescription" rows="8" cols="80" class="form-control" id="PostDescription">
                    <?php echo htmlentities($postUpdate) ?>
                  </textarea>
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
                  </div>
                  <div class="col-lg-6 mb-2">
                    <button type="submit" name="Submit" class="btn btn-danger btn-block">
                      <i class="fas fa-trash"> Delete</i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

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
    <<script type="text/javascript">
      $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>
