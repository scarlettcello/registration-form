<?php

session_start();

//$mysqli = new mysqli('localhost', 'root', '', 'customer') or die(mysqli_error($mysqli));

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$mysqli = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db) or die(mysqli_error($mysqli));;

$update = false;
$firstName = '';
$lastName = '';
$email = '';
$phone = '';

if (isset($_POST['save'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  if ($firstName != '' && $lastName != '' && $email != '') {    
    $mysqli->query(
      "INSERT INTO customer (firstName, lastName, email, phone) 
      VALUES('$firstName', '$lastName', '$email', '$phone')") or die($mysqli->error);
    $_SESSION['message'] = 'Record has been saved!';
    $_SESSION['msg_type'] = 'success';     
  } 

  header("location: list.php");
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM customer WHERE id=$id") or die($mysqli->error);

  $_SESSION['message'] = 'Record has been deleted!';
  $_SESSION['msg_type'] = 'danger';

  header("location: list.php");
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query("SELECT * FROM customer WHERE id=$id") or die($mysqli->error);
  
  // if (count((array)$result) == 1){
  //   $row = $result->fetch_array();
  //   $name = $row['firstName'];
  //   $city = $row['city'];
  // }
  if ($result->num_rows) {
    $row = $result->fetch_array();
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $phone = $row['phone'];
  }
}

if (isset($_GET['cancel'])) {
  $update = false;
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  if ($firstName != '' && $lastName != '' && $email != '') {  
    $mysqli->query(
      "UPDATE customer SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone' 
      WHERE id=$id") or die($mysqli->error());
    $_SESSION['message'] = 'Record has been updated!';
    $_SESSION['msg_type'] = 'warning';
  }

  header("location: list.php");
}

?>