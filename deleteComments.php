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
   $comment_id = $_GET['id'];
   global $connectingDB;
   $sql = "DELETE FROM comments WHERE id='$comment_id'";
   $stmt = $connectingDB->query($sql);
   if ($stmt) {
     $_SESSION["SuccessMessage"] = "Comment Deleted Successfully!";
     Redirect_to("comments.php");
   } else {
     $_SESSION['ErrorMessage'] = "Something Went Wrong Try Again!";
     Redirect_to("comments.php");
   }
 }

  ?>
