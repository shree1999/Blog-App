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
   $sql = "DELETE FROM category WHERE id='$category_id'";
   $stmt = $connectingDB->query($sql);
   if ($stmt) {
     $_SESSION["SuccessMessage"] = "Category Deleted Successfully!";
     Redirect_to("categories.php");
   } else {
     $_SESSION['ErrorMessage'] = "Something Went Wrong Try Again!";
     Redirect_to("categories.php");
   }
 }

  ?>
