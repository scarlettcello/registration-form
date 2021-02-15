<html>
<head>
  <title>PHP CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <link 
    rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous"
  >
  <link rel="stylesheet" href="style.css">
  <script 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
    crossorigin="anonymous"
  >
  </script>
  </head>
<body>
  <?php require_once 'process.php'; ?>

  <?php
    if (isset($_SESSION['message'])) : ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>

    </div>
  <?php endif ?>

  <div class="container-fluid">

    <?php
      $mysqli = new mysqli('localhost', 'root', '', 'customer') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
      //pre_r($result);
    ?>

    <div class="row justify-content-center m-4">
      <h1>Registered List</h1>
    </div>

    <div class="row p-2">
      <div class="col-sm-2"><h3>First Name</h3></div>
      <div class="col-sm-2"><h3>Last Name</h3></div>
      <div class="col-sm-3"><h3>Email</h3></div>
      <div class="col-sm-3"><h3>Phone No.</h3></div>
      <div class="col-sm-2"><h3>Action</h3></div>
    </div>  
    <hr class="bg-black">

    <?php
      while($row = $result->fetch_assoc()) :
    ?>
        
    <div class="row p-2">
      <div class="col-sm-2 pb-1"><?php echo $row['firstName']; ?></div>
      <div class="col-sm-2 pb-1"><?php echo $row['lastName']; ?></div>
      <div class="col-sm-3 pb-1"><?php echo $row['email']; ?></div>
      <div class="col-sm-3 pb-1"><?php echo $row['phone']; ?></div>
      <div class="col-sm-2">
        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
    <hr>   

    <?php endwhile; ?>

    <div class="row p-2">
      <button 
        class="btn btn-secondary" 
        onClick="document.location.href='index.php'"
      >
        Go back to Form
      </button>
    </div>
  </div>

  <?php
    function pre_r( $array ) {
      echo '<pre>';
      print_r($array);
      echo '</pre>';
    }
  ?>
</body>
</html>