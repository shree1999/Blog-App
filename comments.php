<?php require_once('Includes/DB.php'); ?>
<?php require_once('Includes/Functions.php'); ?>
<?php require_once('Includes/Sessions.php'); ?>
<?php
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirm_login();
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
            <h1><i class="fas fa-comment" style="color: #27aae1"></i>Manage Comments</h1>
          </div>
        </div>
      </div>
    </header>
    <!--End of Header-->

    <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-lg-12">
          <?php
          echo ErrorMessage();
          echo SuccessMessage();

           ?>
           <h2>Un-Approved Comments</h2>
           <table class="table table-striped table-hover">
             <thead class="thead-dark">
               <tr>
                 <th>No.</th>
                 <th>Name</th>
                 <th>Date&Time</th>
                 <th>Comment</th>
                 <th>Approve</th>
                 <th>Delete</th>
                 <th>Details</th>
               </tr>
             </thead>
          <?php
          global $connectingDB;
          $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id DESC";
          $stmt = $connectingDB->query($sql);
          $sr_no = 0;
          while ($dataRows = $stmt->fetch()) {
            $commentId = $dataRows['id'];
            $dateTime = $dataRows['datetime'];
            $commenterName = $dataRows['name'];
            $content = $dataRows['comments'];
            $postId = $dataRows['post_id'];
            $sr_no++;
           ?>
           <tbody>
             <tr>
               <td><?php echo htmlentities($sr_no); ?></td>
               <td><?php echo htmlentities($commenterName); ?></td>
               <td><?php echo htmlentities($dateTime); ?></td>
               <td><?php echo htmlentities($content); ?></td>
               <td>  <a href="approveComments.php?id=<?php echo $commentId; ?>" class="btn btn-success">Approve</a> </td>
               <td> <a href="deleteComment.php?id=<?php echo $commentId; ?>" class="btn btn-danger">Delete</a> </td>
               <td style="min-width:140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $postId; ?>">See Post</a></td>
             </tr>
           </tbody>
         <?php } ?>
       </table>
       <hr>
       <h2>Approved Comments</h2>
       <table class="table table-striped table-hover">
         <thead class="thead-dark">
           <tr>
             <th>No.</th>
             <th>Name</th>
             <th>Date&Time</th>
             <th>Comment</th>
             <th>Revert</th>
             <th>Delete</th>
             <th>Details</th>
           </tr>
         </thead>
      <?php
      global $connectingDB;
      $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id DESC";
      $stmt = $connectingDB->query($sql);
      $sr_no = 0;
      while ($dataRows = $stmt->fetch()) {
        $commentId = $dataRows['id'];
        $dateTime = $dataRows['datetime'];
        $commenterName = $dataRows['name'];
        $content = $dataRows['comments'];
        $postId = $dataRows['post_id'];
        $sr_no++;
       ?>
       <tbody>
         <tr>
           <td><?php echo htmlentities($sr_no); ?></td>
           <td><?php echo htmlentities($commenterName); ?></td>
           <td><?php echo htmlentities($dateTime); ?></td>
           <td><?php echo htmlentities($content); ?></td>
           <td style="min-width:140px;">  <a href="disApproveComments.php?id=<?php echo $commentId; ?>" class="btn btn-warning">Dis-Approve</a> </td>
           <td> <a href="deleteComment.php?id=<?php echo $commentId; ?>" class="btn btn-danger">Delete</a> </td>
           <td style="min-width:140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $postId; ?>">See Post</a></td>
         </tr>
       </tbody>
     <?php } ?>
    </table>
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
    <script type="text/javascript">
      $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>
