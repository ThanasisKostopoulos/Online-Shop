
<div id="header">
  <div id="left">

    <?php include "SideNav.php";?>
  
    <label><a href="index.php">TechEshop</a> </label>
  </div>
    <div id="right">
      <div id="content">

        <?php
            session_start();
            include_once "dbcontroller.php";

            $db_handle = new DBController();
            $connection = $db_handle->connectDB();
            
            if(isset($_SESSION['user']))
            {
              $res= mysqli_query($connection,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
              $userRow= mysqli_fetch_array($res);
            
              if($userRow['role']=='')
              { 
                echo ' Hi ';
                echo $userRow['name'];
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="index.php">Home</a>';
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="About.php?logout">About</a>';
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="UserOrders.php">Orders</a>';
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="EditProfile.php">Edit Profile</a>';
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="Logout.php?logout">Sign Out</a>';
              }
              else
              {
                echo ' Hi ';
                echo $userRow['name'];
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="index.php">Home</a>';
                echo '&nbsp&nbsp&nbsp;&nbsp&nbsp<a href="AddProducts.php">Add Products</a>';
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="OrderHistory.php">Orders</a>';
                echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="Logout.php?logout">Sign Out</a>';
              }              
            }
            else
            {
              echo 'Guest ';
              echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="index.php">Home</a>';
              echo '&nbsp&nbsp&nbsp&nbsp&nbsp;<a href="About.php?logout">About</a>';
              echo '&nbsp;&nbsp;&nbsp&nbsp&nbsp;<a href="Login.php">Login</a>';
              echo '&nbsp;&nbsp;&nbsp&nbsp&nbsp;<a href="SignUp.php">Sign Up</a>';
            }  
        ?>
    </div>
  </div>
</div>
