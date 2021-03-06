<?php
  require_once("Includes/DB.php");
 ?>
 <?php
  require_once("Includes/Functions.php");
  ?>
<?php
  require_once("Includes/sessions.php")
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
    <style media="screen">

      .heading {
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
        font-weight: bold;
        color: #005E90;
      }
      .heading:hover {
        color: #0090DB;
      }
    </style>
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
              <a href="blog.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">About Us</a>
            </li>
            <li class="nav-item">
              <a href="blog.php?page=1" class="nav-link active">Blog</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Contact Us</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Features</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <form class="form-inline d-none d-sm-block" action="blog.php">
              <div class="form-group">
                <input class="form-control mr-2" type="text" name="Search" placeholder="Search Here" value="">
                <button class="btn btn-primary" name="searchButton">Search</button>
              </div>

            </form>
          </ul>
        </div>
      </div>
    </nav>
    <div style="height:10px; background-color: #27aae1;"></div>
    <!-- End of Navbar -->

    <!-- Header -->
    <div class="container">
      <div class="row mt-4">

        <!--Main Area-->
        <div class="col-sm-8">
          <h1>A Complete Responsive CMS Blog</h1>
          <h1 class="lead"> The Complete Blog By Shreeansh Gupta and Sangam Prasad</h1>
          <?php

            echo ErrorMessage();
            echo SuccessMessage();

           ?>
          <?php
          // For searching...
          global $connectingDB;
            if (isset($_GET["searchButton"])) {
              $search = $_GET["Search"];
              $sql = "SELECT * FROM posts WHERE datetime LIKE :search
                OR title LIKE :search
                OR category LIKE :search
                OR post LIKE :search";

                $stmt = $connectingDB->prepare($sql);
                $stmt->bindValue(':search', '%'.$search.'%');
                $stmt->execute();

            }
            else if (isset($_GET['category'])) {
              $categoryNameFromUrl = $_GET['category'];
              $sql = "SELECT * FROM posts WHERE category=:name";
              $stmt = $connectingDB->prepare($sql);
              $stmt->bindValue(':name', $categoryNameFromUrl);
              $stmt->execute();
            }
            else {
              //default sql query...
              $sql = "SELECT * FROM posts ORDER BY id DESC";
              $stmt = $connectingDB->query($sql);
            }

            while ($data = $stmt->fetch()) {
              $postId = $data["id"];
              $dateTime = $data["datetime"];
              $postTitle = $data["title"];
              $category = $data["category"];
              $admin = $data["author"];
              $image = $data["image"];
              $postDescription = $data["post"];

           ?>
           <div class="card mb-4">
             <img src="Uploads/<?php echo htmlentities($image) ?>" alt="" class="img-fluid card-img-top" style="max-height: 450px;">
             <div class="card-body">
               <h4 class="card-title"><?php echo htmlentities($postTitle); ?></h4>
               <small class="text-muted">By: <?php echo htmlentities($admin); ?> On: <?php echo htmlentities($dateTime); ?></small>
               <small class="badge badge-dark" style="float:right;"><?php

               global $connectingDB;
               $sqlApproved = "SELECT COUNT(*) FROM comments WHERE post_id='$postId' AND status='ON'";
               $stmtApproved = $connectingDB->query($sqlApproved);
               $arr_count = $stmtApproved->fetch();

               $totalCount = array_shift($arr_count);

               echo "Comments".htmlentities($totalCount);

                ?>
              </small>
               <hr>
               <p class="card-text"><?php if (strlen($postDescription) > 150) {
                 $postDescription = substr($postDescription,0,150)."...";
               }
               echo htmlentities($postDescription)
               ?></p>
               <a href="FullPost.php?id=<?php echo $postId; ?>" style="float:right;">
                 <span class="btn btn-info">Read More >></span>
               </a>

             </div>

           </div>
         <?php } ?>
        </div>

        <!--Main Area End-->


        <!--Side Area-->
        <div class="col-sm-4">
          <div class="card mt-4">
            <div class="card-body">
              <img src="Images/rose.jpeg" alt="rose" class="d-block img-fluid mb-3">
              <div class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header bg-dark">
              <h2 class="lead">Sign Up!</h2>
            </div>
            <div class="card-body">
              <a href="index.php" class="btn btn-warning btn-block text-center text-white mb-4">Join The Forum</a>
              <a href="index.php" class="btn btn-success btn-block text-center text-white mb-4">Login</a>
              <a href="logout.php" class="btn btn-danger btn-block text-center text-white mb-4"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-primary text-light">
              <h2 class="lead">Categories</h2>
            </div>
            <div class="card-body">
              <?php
                global $connectingDB;
                $sql = "SELECT * FROM category ORDER BY id DESC";
                $stmt = $connectingDB->query($sql);
                while ($data = $stmt->fetch()) {
                  $Id = $data['id'];
                  $name = $data['title'];
               ?>
              <a href="blog.php?category=<?php echo $name; ?>"><span class="heading"><?php echo htmlentities($name)."<br>"; ?></span></a>
             <?php } ?>
            </div>
          </div>

          <br>
          <div class="card">
            <div class="card-header bg-info text-white">
              <h2 class="lead">Recent Posts</h2>
            </div>
            <div class="card-body">
              <?php
              global $connectingDB;
              $sql = "SELECT * from posts ORDER BY id DESC LIMIT 0,5";
              $stmt = $connectingDB->query($sql);
              while ($data = $stmt->fetch()) {
                $id = $data['id'];
                $title = $data['title'];
                $dateTime = $data['datetime'];
                $image = $data['image'];
               ?>
              <div class="media">
                <img src="Uploads/<?php echo $image; ?>"class="d-block img-fluid align-self-start" alt="" width="90" height="94">
                <div class="media-body ml-2">
                  <a href="FullPost.php?id=<?php echo $id; ?>" target="_blank"><h6 class="lead"><?php echo htmlentities($title); ?></h6></a>
                  <p class="small"><?php echo htmlentities($dateTime); ?></p>
                </div>
              </div>
              <hr>
            <?php } ?>
            </div>
          </div>

        </div>
        <!--Side Area End-->

      </div>
    </div>
    <!--End of Header-->
    <br>
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
