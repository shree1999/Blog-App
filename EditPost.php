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

 if (isset($_POST['Submit'])) {

   $title = $_POST['PostTitle'];
   $admin = $_SESSION['UserName'];
   $category = $_POST["Category"];
   $Image = $_FILES["Image"]["name"];
   $target = "Uploads/".basename($_FILES["Image"]["name"]);
   $PostText = $_POST["PostDescription"];

   date_default_timezone_set("Asia/Kolkata");
   $currtime = time();
   $dateTime = strftime("%Y-%m-%d %H:%M:%S", $currtime);

   if (empty($title)) {
     $_SESSION["ErrorMessage"] = "Title can't be empty";
     Redirect_to("posts.php");
   } else if (strlen($title) < 5) {
     $_SESSION["ErrorMessage"] = "Title should be greater then 5 characters";
     Redirect_to("posts.php");
   } else if (strlen($title) > 9999) {
     $_SESSION["ErrorMessage"] = "Title should be less then 10000 characters";
     Redirect_to("posts.php");
   } else {
     // udate query...
     global $connectingDB;
     if (!empty($_FILES["Image"]["name"])) {
       $sql = "UPDATE posts SET title='$title', category='$category', image='$Image', post='$PostText'
       WHERE id='$searchQuery'";

     } else {
       $sql = "UPDATE posts SET title='$title', category='$category', post='$PostText'
        WHERE id='$searchQuery'";
     }

     move_uploaded_file($_FILES["Image"]["tmp_name"], $target);
     $execute = $connectingDB->query($sql);
     if ($execute) {

       $_SESSION["SuccessMessage"] = "Post with id: ".$connectingDB->lastInsertId()." updated Successfully";
       Redirect_to("posts.php");

     } else {
       $_SESSION["ErrorMessage"] = "Something Went Wrong!!";
       Redirect_to("posts.php");
     }

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
            <h1><i class="fas fa-edit" style="color: #27aae1"></i>Edit Post</h1>
          </div>
        </div>
      </div>
    </header>
    <!--End of Header-->

    <!--Main Area-->
    <section class="container py-2 mb-4">
      <div class="row justify-content-center">
        <div class="offset-lg-1 col-lg-10 align-items-center" style="min-height: 360px;">
          <?php echo ErrorMessage();

            echo SuccessMessage();
            global $connectingDB;
            $sql = "SELECT * FROM posts WHERE id='$searchQuery'";
            $stmt = $connectingDB->query($sql);
            while ($data = $stmt->fetch()) {
              $titleUpdate = $data["title"];
              $categoryUpdate = $data["category"];
              $imageUpdate = $data["image"];
              $postUpdate = $data["post"];

            }
           ?>
          <form class="" action="EditPost.php?id=<?php echo $searchQuery ?>" method="post" enctype="multipart/form-data">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"><span class="fieldInfo">Category Title: </span></label>
                  <input class="form-control" type="text" id="title" name="PostTitle" placeholder="Type Title Here" value="<?php echo htmlentities($titleUpdate); ?>">
                </div>
                <div class="form-group">
                  <span class="fieldInfo">Existing Categories: </span>
                  <?php echo htmlentities($categoryUpdate); ?>
                  <br>
                  <label for="title"><span class="fieldInfo">Choose Category </span></label>
                    <select class="form-control" id="categoryTitle" name="Category">
                      <?php


                          global $connectingDB;

                          $sql = "SELECT id, title FROM category";
                          $stmt = $connectingDB->query($sql);
                          while ($DateRows = $stmt->fetch()) {
                            $Id = $DateRows["id"];
                            $CategoryName = $DateRows["title"];
                            echo '<option>' .$CategoryName. '</option>';
                          }

                       ?>

                    </select>
                </div>
                <div class="form-group mb-1">
                  <span class="fieldInfo">Existing Image: </span>
                    <img class="mb-1" src="Uploads/<?php echo $imageUpdate ?>" alt="" height="70px" width="170px">
                  <div class="custom-file">
                    <input class="custom-file-input" type="file" name="Image" id="imageSelect" value="">
                    <label for="imageSelect" class="custom-file-label"></label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Post"><span class="fieldInfo"> Post: </span></label>
                  <textarea name="PostDescription" rows="8" cols="80" class="form-control" id="PostDescription">
                    <?php echo htmlentities($postUpdate) ?>
                  </textarea>
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
                  </div>
                  <div class="col-lg-6 mb-2">
                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                      <i class="fas fa-check"> Publish</i>
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
