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

  <div class="container">
    <div class="row justify-content-center m-4">
      <h1>Registration Form</h1>
    </div>
    <div class="row justify-content-center p-4">
      <p>Fill out the form below to register or <a href="list.php">Click&nbsp;here</a> to edit existing data.</p>
    </div>
    <div class="row justify-content-center p-4">
      <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
          <label for="firstName">First Name <span>*</span></label>
          <input 
            class="form-control" 
            type="text" 
            name="firstName" 
            value="<?php echo $firstName; ?>"
            placeholder="Enter the first name" 
            required
          />
        </div>
        <div class="form-group">
          <label for="lastName">Last Name <span>*</span></label>
          <input 
            class="form-control" 
            type="text" 
            name="lastName" 
            value="<?php echo $lastName; ?>"
            placeholder="Enter the lastName" 
            required
          />
        </div>
        <div class="form-group">
          <label for="email">Email <span>*</span></label>
          <input 
            class="form-control" 
            type="email" 
            name="email"
            value="<?php echo $email; ?>" 
            placeholder="Enter the email address"
            required 
          />   
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input 
            class="form-control" 
            type="text" 
            name="phone"
            value="<?php echo $phone; ?>" 
            placeholder="Enter the phone number"
          />   
        </div>      
        <div class="form-group">
        <?php
          if ($update == true):
        ?>
          <button class="btn btn-primary" type="submit" name="update">Update</button>
          <input 
            type="button" 
            class="btn btn-secondary" 
            type="submit" 
            name="cancel" 
            value="Cancel" 
            onClick="document.location.href='list.php'"
          />
        <?php else: ?>
          <button class="btn btn-primary" type="submit" name="save">Submit</button>
        <?php endif ?>
        </div>
      </form>
    </div>
  </div>
</body>
</html>