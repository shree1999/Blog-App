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
            <h1><i class="fas fa-cog" style="color: #27aae1"></i>Dashboard</h1>
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
      <?php
      echo ErrorMessage();
      echo SuccessMessage();

       ?>

        <div class="row">

        <div class="col-lg-2 d-none d-md-block">
            <div class="card text-center bg-dark text-white mb-3">
              <div class="card-body">
                <h1 class="lead">Posts</h1>
                <h4 class="display-5">
                <i class="fab fa-readme"></i>
                <?php
                  echo countTotalRows('posts');
                 ?>
                </h4>
              </div>
            </div>
            <div class="card text-center bg-dark text-white mb-3">
              <div class="card-body">
                <h1 class="lead">Categories</h1>
                <h4 class="display-5">
                <i class="fas fa-folder"></i>
                <?php
                echo countTotalRows('category');
                 ?>
                </h4>
              </div>
            </div>
            <div class="card text-center bg-dark text-white mb-3">
              <div class="card-body">
                <h1 class="lead">Admins</h1>
                <h4 class="display-5">
                <i class="fas fa-users"></i>
                <?php
                echo countTotalRows('admins');
                 ?>
                </h4>
              </div>
            </div>

            <div class="card text-center bg-dark text-white mb-3">
              <div class="card-body">
                <h1 class="lead">Comments</h1>
                <h4 class="display-5">
                <i class="fab fa-comments"></i>
                <?php
                echo countTotalRows('comments');
                 ?>
                </h4>
              </div>
            </div>
          </div>

          <!--Right side of the Dashboard-->
          <div class="col-lg-10">
            <h1>Top Posts</h1>
            <table class="table table-striped table-hover">
              <thead class="thead-dark">
                <th>No.</th>
                <th>Title</th>
                <th>Date&Time</th>
                <th>Author</th>
                <th>Comments</th>
                <th>Details</th>
              </thead>

              <?php
              global $connectingDB;
              $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 0,5";
              $stmt = $connectingDB->query($sql);
              $sr_no = 0;
              while ($dataRows = $stmt->fetch()) {
                $post_id = $dataRows["id"];
                $dateTime = $dataRows["datetime"];
                $title = $dataRows["title"];
                $author = $dataRows["author"];
                $sr_no++;

               ?>
               <tbody>
                 <tr>
                   <td><?php echo htmlentities($sr_no); ?></td>
                   <td><?php echo htmlentities($title); ?></td>
                   <td><?php echo htmlentities($dateTime); ?></td>
                   <td><?php echo htmlentities($author); ?></td>
                   <td>
                     <?php
                     global $connectingDB;
                     $sqlApproved = "SELECT COUNT(*) FROM comments WHERE post_id='$post_id' AND status='ON'";
                     $stmtApproved = $connectingDB->query($sqlApproved);
                     $arr_count = $stmtApproved->fetch();

                     $totalCount = array_shift($arr_count);
                     if ($totalCount > 0) {
                       ?>
                       <span class="badge badge-success">
                         <?php
                        echo htmlentities($totalCount); ?>
                  <?php } ?>

                   </span>

                     <?php
                     global $connectingDB;
                     $sqldisApproved = "SELECT COUNT(*) FROM comments WHERE post_id='$post_id' AND status='OFF'";
                     $stmtdisApproved = $connectingDB->query($sqldisApproved);
                     $arr_count = $stmtdisApproved->fetch();
                     $totalCount = array_shift($arr_count);

                     if ($totalCount > 0) {
                        ?>
                        <span class="badge badge-danger">
                      <?php echo htmlentities($totalCount); ?>
                  <?php } ?>




                   </span>
                    </td>
                   <td> <a href="FullPost.php?id=<?php echo $post_id; ?>"class="btn btn-info">Preview</a> </td>
                 </tr>
               </tbody>

             <?php } ?>
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
