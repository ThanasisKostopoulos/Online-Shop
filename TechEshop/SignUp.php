<?php

	include "NavigationBar.php";
	include "Footer.php";

	require_once("dbcontroller.php");

    if(isset($_SESSION['user'])){
        header("Location: index.php");    
        exit;   
    }
        
    $db_handle = new DBController();
	$connection = $db_handle->connectDB();
    if(isset($_POST['btn-signup']))
    {
        if($_POST["psw"] === $_POST["psw-repeat"])
        {
            $name= $_POST['name'];
            $psw= $_POST['psw'];
            $email= $_POST['email'];
            mysqli_query($connection,"INSERT INTO users(name, password, email, role) VALUES ('$name','$psw','$email','')");
            
            $res=mysqli_query($connection,"SELECT * FROM users WHERE email='$email'");
		    $row=mysqli_fetch_array($res);
            $_SESSION['user'] = $row['user_id'];
            header("Location: index.php");
        }
        else 
        {
            ?>
            <center><span style="background-color: #f44336"}>Password and Repeated Password do not match. Try again!</span></center>
        <?php
        }
    }

?>

    <center>
    <div id="signup-form">
        <form method="post">    
            <div class="container">
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <label for="name"><b>Name</b></label>
            <br>
            <input type="text" placeholder="Enter a Name" name="name" required>
            <br><br>
            <label for="email"><b>Email</b></label>
            <br>
            <input type="email" placeholder="Enter Email" name="email" required>
            <br><br>
            <label for="psw"><b>Password</b></label>
            <br>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <br><br>
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <br>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
            <br><br>
            <p>By creating an account you agree to our <a href="#" style="color:maroon">Terms & Privacy</a>.</p>
            <br><br>
            <div class="clearfix">
                <button type="submit" name="btn-signup">Sign Up</button>
            </div>
            </div>
        </form>
        </div>
    </div>
    </center>
    <?php    
    
?>

<!-- CSS connection -->
<HTML>
<HEAD>
<TITLE>TechEShop</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>