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
 if (isset($_SESSION['casualUserName'])) {
   Redirect_to('blog.php');
 }
 if (isset($_POST['Submit'])) {
    $userName = $_POST["userName"];
    $pwd = $_POST['password'];

    if (empty($userName) || empty($pwd)) {
      $_SESSION["ErrorMessage"] = "Fields must be not empty";
      Redirect_to("userLogin.php");
    } else {

      global $connectingDB;
      $sql = "SELECT * FROM users WHERE username=:USERNAME";
      $stmt = $connectingDB->prepare($sql);
      $stmt->bindValue(':USERNAME',$userName);
      $stmt->execute();

      if ($result = $stmt->fetch()) {
        $pwdCheck = password_verify($pwd, $result['password']);

        if ($pwdCheck == false) {
          $_SESSION["ErrorMessage"] = "Incorrect password/username";
          Redirect_to("userLogin.php");
        } else if ($pwdCheck == true) {
          $_SESSION['Casual_user_uid'] = $result['id'];
          $_SESSION['casualUserName'] = $result['username'];
          $_SESSION['SuccessMessage'] = "Welcome back $userName";
          Redirect_to('blog.php');
        }
      } else {
        $_SESSION['ErrorMessage'] = "No User Exists";
        Redirect_to('index.php');
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
      </div>
    </nav>
    <div style="height:10px; background-color: #27aae1;"></div>
    <!-- End of Navbar -->

    <!-- Header -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1></h1>
          </div>
        </div>
      </div>
    </header>
    <!--End of Header-->

    <div class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height: 400px;">
          <br><br><br>
          <?php
          echo ErrorMessage();
          echo SuccessMessage();

           ?>
          <div class="card bg-secondary text-light">
            <div class="card-header">
              <h4>Welcome Back!</h4>
            </div>
            <div class="card-body bg-dark">
            <form class="" action="userLogin.php" method="post">
              <div class="form-group">
                <label for="username"><span class="fieldInfo">Username:</span></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" name="userName" value="" id="username">
                </div>
              </div>
              <div class="form-group">
                <label for="password"><span class="fieldInfo">Password:</span></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-danger"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" id="password" name="password" value="">
                </div>
              </div>
              <input type="submit" name="Submit" class="btn btn-success btn-block" value="Login">
            </form>
          </div>
        </div>
        </div>
      </div>

    </div>


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
