<?php require_once('Includes/Functions.php') ?>

<?php require_once('Includes/Sessions.php') ?>

<?php

  $_SESSION['User_id'] = null;
  $_SESSION['UserName'] = null;
  $_SESSION['AdminName'] = null;

  $_SESSION['casualUserName'] = null;
  $_SESSION['Casual_user_uid'] = null;

  session_destroy();

  Redirect_to("index.php");
 ?>
