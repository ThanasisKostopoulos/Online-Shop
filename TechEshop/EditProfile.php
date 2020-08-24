<?php

	include "NavigationBar.php";
	include "Footer.php";

	require_once("dbcontroller.php");

    $db_handle = new DBController();
	$connection = $db_handle->connectDB();
    
    if(isset($_SESSION['user']))
	{
        $res= mysqli_query($connection,"SELECT * FROM users WHERE user_id=".$_SESSION['user']) or die("Error: " . mysqli_error($connection));
        $userRow= mysqli_fetch_array($res);

            $userid= $userRow['user_id'];
            $userpsw= $userRow['password'];

            ?>  
            <script>console.log($userRow['user_id']);</script>   
            <?php       

        if(isset($_POST['btn-edit'])!='')
        {
            $name= $_POST['name'];
            $email= $_POST['email'];
            $psw= $_POST['psw'];
            $psw_new= $_POST['psw-new'];


            $update_values = array();
            
            if(!empty($name))
                    $update_values[] = "name='".$name."'";
            $update_values_imploded = implode(', ', $update_values);
            if(!empty($email))
                    $update_values[] = "email='".$email."'";
            $update_values_imploded = implode(', ', $update_values);

            if($psw!=$userpsw)//wrong current password
            {
                ?>
                 <script>alert('Wrong password. Try again!')</script>
                <?php 
            }
            else
            {
                if(!empty($psw_new))
                    $update_values[] = "password='".$psw_new."'";
                $update_values_imploded = implode(', ', $update_values);
            }
            
            if( !empty($update_values) )
            {
                $q = "UPDATE users SET $update_values_imploded WHERE user_id='$userid' ";
                $r = mysqli_query($connection,$q);
            }
        }    
    }
    else
    {
        header("Location: index.php");
    }

?>

<!-- CSS connection -->
<HTML>
<HEAD>
<TITLE>TechEShop</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<center>
    <div id="edit-form">
        <form method="post">    
            <div class="container">
            <h1>Update your Account Details</h1>
            <p>Update the field(s) you want to change!</p>
            <hr>
            <label for="name"><b>Change Name</b></label>
            <br><br>
            <input type="text" placeholder="Change Name" name="name">
            <br><br>
            <br><br> 
            <label for="email"><b>Change Email Address</b></label>
            <br><br>
            <input type="email" placeholder="Change Email Address" name="email">
            <br><br>
            <br><br>   
            <label for="psw"><b>Enter Old Password</b></label>
            <br><br>
            <input type="password" placeholder="Enter Old Password" name="psw"> 
            <br><br>
            <label for="psw-new"><b>Enter New Password</b></label>
            <br><br>
            <input type="password" placeholder="Enter New Password" name="psw-new">
            <br><br>
            <div class="clearfix">
                <button type="submit" name="btn-edit">Update</button>
            </div>
            </div>
        </form>
    </div>
    </div>
    </center>
