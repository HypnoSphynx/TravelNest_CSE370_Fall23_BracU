<!DOCTYPE html>
<?php
include connection.php
$name='zawadul karim'
$email='zawadul1@gmail.com'
$password='zawad1234'
$sql="INSERT into customer values
        (c_id,$name,$email,$password,01814267904,0)"

?>
<html>
    <head>
        <title>Travel Nest- Sign Up</title>
        <link rel="stylesheet" href="signup.css"> <!--importing CSS file-->

    
    </head>
<body class="body-class"><!--class helping to identify the css button-->
    
</body>
    <div class="login-box">
        <div class="user-placing">
        </div>
        <div class="login-box-content">
            <!--use <form> to import from php-->
            <h4>Sign Up</h4>
                
                <br>
                <br>
                <br>
            <input type="text" name="f_name" placeholder="First Name" height='100'><br><br>
            <input type="text" name="l_name" placeholder="Last Name"><br><br>
            <input type="text" name="city" placeholder="City"><br><br>
            <input type="text" name="address" placeholder="Address"><br><br>
            <input type="text" name="country" placeholder="Country"><br><br>
            <input type="email" name="email" placeholder="Email"><br><br>
            
            <br>
            <input type="password" name="password" placeholder="Password"><br>


        </div>
    <div>
        <input type="submit" name="submit" value="Sign up" class="login-button">
    </div>

</html>