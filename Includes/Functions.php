<?php
  require_once('DB.php');
 ?>

<?php

  function Redirect_to($New_Location) {

    header("Location:".$New_Location);
    exit;
  }

  function checkUserNameExist($userName, $table) {
    global $connectingDB;

    $sql = "SELECT username FROM $table WHERE username=:userName";

    $stmt = $connectingDB->prepare($sql);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $dataRows = $stmt->rowcount();

    if ($dataRows >= 1) {
      return true;
    } else {
      return false;
    }
  }

  function loginAttempt($userName, $pwd) {
    global $connectingDB;
    $sql = "SELECT * FROM admins WHERE username=:userName AND password=:Password LIMIT 1";
    $stmt = $connectingDB->prepare($sql);
    $stmt->bindValue(':userName',$userName);
    $stmt->bindValue(':Password',$pwd);

    $stmt->execute();
    $result = $stmt->rowcount();

    if ($result == 1) {
      return $found = $stmt->fetch();
    } else {
      return null;
    }

  }

  function confirm_login () {
    if (isset($_SESSION['User_id'])) {
      return true;
    }
    else {
      $_SESSION['ErrorMessage'] = 'Login Required';
      Redirect_to("login.php");
    }
  }

  function countTotalRows($tableName) {
    global $connectingDB;
    $sql = "SELECT COUNT(*) FROM $tableName";
    $stmt = $connectingDB->query($sql);
    $result = $stmt->fetch();  // fetches the result in the form of array.
    $totalCount = array_shift($result);
    return ($totalCount);
  }

 ?>
