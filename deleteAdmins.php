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
 if (isset($_GET['id'])) {
   $category_id = $_GET['id'];
   global $connectingDB;
   $sql = "DELETE FROM admins WHERE id='$category_id'";
   $stmt = $connectingDB->query($sql);
   if ($stmt) {
     $_SESSION["SuccessMessage"] = "Admin removed Successfully!";
     Redirect_to("admins.php");
   } else {
     $_SESSION['ErrorMessage'] = "Something Went Wrong Try Again!";
     Redirect_to("admins.php");
   }
 }

  ?>
