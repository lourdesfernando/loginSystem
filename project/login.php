<?php 
include("connection.php");
$loginError="";
if (isset($_POST["login"])){
    function validateFormData($formData){
        $formData=trim(stripslashes(htmlspecialchars($formData)));
        return $formData;
    }
    $formUser=validateFormData($_POST["username"]);
    $formPass=validateFormData($_POST["password"]);
    $query="SELECT name, email, password FROM users WHERE name='$formUser'";
    $result=mysqli_query($connection,$query);
    
    if(mysqli_num_rows($result)>0){
        while($rows=mysqli_fetch_assoc($result)){
            $user=$rows['name'];
            $email=$rows['email'];
            $hashedPass=$rows['password'];
        }
        if(password_verify($formPass,$hashedPass)){
            session_start();
            $_SESSION['loggedInUser']=$user;
            $_SESSION['loggedInEmail']=$email;
            header("Location: profile.php");
        }else{
            $loginError="<div class='alert alert-danger'>Wrong username/password combination.Try again.</div>";
        }
        
    }else{
        $loginError="<div class='alert alert-danger'>No such user in database. Try again.<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    
mysqli_close($connection);
}
   

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
    <p class="lead"> Use this form to login to your account!</p>
     <?php echo $loginError; ?>
    <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group">
       <label for="login-username" class="sr-only">Username</label>
       <input type="text" name="username" placeholder="username" id="login-username"><br><br>
        </div>
         <div class="form-group">
       <label for="login-password" class="sr-only">Password</label>
       <input type="password" placeholder="password" name="password" id="login-password"><br><br>
       </div>
        <button type="submit" class="btn btn-default" name="login">Login</button><br><br>
        
        
    </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>