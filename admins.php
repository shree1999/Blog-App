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
 <?php
 if (isset($_POST['Submit'])) {
   $userName = $_POST['userName'];
   $name = $_POST['Name'];
   $pwd = $_POST['Password'];
   $confpwd = $_POST['PasswordConfirm'];
   $admin = $_SESSION['UserName'];
   date_default_timezone_set("Asia/Kolkata");
   $currtime = time();
   $dateTime = strftime("%Y-%m-%d %H:%M:%S", $currtime);

   if (empty($userName)||empty($pwd)||empty($confpwd)) {
     $_SESSION["ErrorMessage"] = "All Fields must be filled out";
     Redirect_to("admins.php");
   } else if (strlen($userName) < 3) {
     $_SESSION["ErrorMessage"] = "Username should be greater then 2 characters";
     Redirect_to("admins.php");
   } else if (strlen($userName) > 50) {
     $_SESSION["ErrorMessage"] = "Username should be less then 50 characters";
     Redirect_to("admins.php");
   } else if ($pwd !== $confpwd) {
     $_SESSION["ErrorMessage"] = "Password doesn't match";
     Redirect_to("admins.php");
   } else if (checkUserNameExist($userName, 'admins')) {
     $_SESSION["ErrorMessage"] = "Username already exist";
     Redirect_to("admins.php");
   }

   else {
     global $connectingDB;
     $sql = "INSERT INTO admins(datetime, username, password, aname, addedby)";
     $sql .= "VALUES(:dateTime,:userName,:password,:aname,:adminName)";    // dummy variable to prevent sql injection
     $stmt = $connectingDB->prepare($sql);
     $stmt->bindValue(':dateTime',$dateTime);
     $stmt->bindValue(':userName',$userName);
     $stmt->bindValue(':password',$pwd);
     $stmt->bindValue(':aname',$name);
     $stmt->bindValue(':adminName',$admin);

     $execute=$stmt->execute();

     if ($execute) {

       $_SESSION["SuccessMessage"] = "Admin added Successfully";
       Redirect_to("admins.php");

     } else {
       $_SESSION["ErrorMessage"] = "Something Went Wrong!!";
       Redirect_to("admins.php");
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
            <h1><i class="fas fa-edit" style="color: #27aae1"></i>Manage Admins</h1>
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

           ?>
          <form class="" action="admins.php" method="post">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-header">
                <h1>Add New Admin</h1>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"><span class="fieldInfo">Username: </span></label>
                  <input class="form-control" type="text" id="title" name="userName" placeholder="Type Username Here" value="">
                </div>
                <div class="form-group">
                  <label for="name"><span class="fieldInfo">Name: </span></label>
                  <input class="form-control" type="text" id="name" name="Name" placeholder="Type Name Here" value="">
                  <small class="text-muted">Optional</small>
                </div>
                <div class="form-group">
                  <label for="Password"><span class="fieldInfo">Password: </span></label>
                  <input class="form-control" type="password" id="Password" name="Password" placeholder="Type Password Here" value="">
                </div>
                <div class="form-group">
                  <label for="confirm"><span class="fieldInfo">Confirm Password: </span></label>
                  <input class="form-control" type="password" id="confirm" name="PasswordConfirm" placeholder="Rewrite Password Here" value="">
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
          <h2>Existing Admins</h2>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No.</th>
                <th>Date&Time</th>
                <th>Admin Name</th>
                <th>Added By</th>
                <th>Delete</th>
              </tr>
            </thead>
         <?php
         global $connectingDB;
         $sql = "SELECT * FROM admins";
         $stmt = $connectingDB->query($sql);
         $sr_no = 0;
         while ($dataRows = $stmt->fetch()) {
           $Id = $dataRows['id'];
           $dateTime = $dataRows['datetime'];
           $adminName = $dataRows['username'];
           $addedby = $dataRows['addedby'];
           $sr_no++;
          ?>
          <tbody>
            <tr>
              <td><?php echo htmlentities($sr_no); ?></td>
              <td><?php echo htmlentities($dateTime); ?></td>
              <td><?php echo htmlentities($adminName); ?></td>
              <td><?php echo htmlentities($addedby); ?></td>
              <td> <a href="deleteAdmins.php?id=<?php echo $Id; ?>" class="btn btn-danger">Delete</a> </td>
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
    <<script type="text/javascript">
      $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>
