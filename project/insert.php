<?php 
include("connection.php");
if (isset($_POST["add"])){
    function validateFormData($formData){
        $formData=trim(stripslashes(htmlspecialchars($formData)));
        return $formData;
    }
    $nameError=$emailError=$passwordError="";
    $name=$email=$password="";
    if (!$_POST["username"]){
        $nameError="Please enter your name <br>";
    }else{
        $name=validateFormData($_POST["username"]);
    }
    if (!$_POST["email"]){
        $emailError="Please enter your email <br>";
    }else{
        $email=validateFormData($_POST["email"]);
    }
    if (!$_POST["password"]){
        $passwordError="Please enter your password <br>";
    }else{
        $password=validateFormData($_POST["password"]);
        $hashedpass=password_hash($password,PASSWORD_DEFAULT);
    }
    if($name && $email && $password){
        $query="INSERT INTO users(id,name,email,password,date)
VALUES (NULL,'$name','$email','$hashedpass',CURRENT_TIMESTAMP)";
        if(mysqli_query($connection,$query)){
            echo "<div class='alert alert-success'>New record in database</div>";
        }else{
            echo "Error ".$query."<br>".mysqli_error($connection);
        }
    }
}
mysqli_close($connection);

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Login Form</title>
  </head>
  <body>
   <div class="container">
    <h1>Login Form</h1> 
    <p class="text-danger">* Required fields</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
       <small class="text-danger">* <?php echo $nameError; ?></small>
       <input type="text" placeholder="Username" name="username"><br><br>
       <small class="text-danger">* <?php echo $emailError; ?></small>
       <input type="text" placeholder="Email" name="email"><br><br>
       <small class="text-danger">* <?php echo $passwordError; ?></small>
       <input type="password" placeholder="Password" name="password"><br><br>
       <input type="submit" placeholder="Add" name="add"><br><br>
        
        
    </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>