<?php
	include "NavigationBar.php";
	include "Footer.php";;

	require_once("dbcontroller.php");

    $db_handle = new DBController();
    $connection = $db_handle->connectDB();

    $query= mysqli_query($connection,"SELECT * FROM order_items ORDER BY datetime DESC") or die("Error: " . mysqli_error($connection));

    echo "<br>";
    ?>
    <h2>Products ordered</h2>
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tr>
            <th style="text-align:center; background-color: #dddddd;">User ID</th>
            <th style="text-align:center; background-color: #dddddd;">Product Name</th>
            <th style="text-align:center; background-color: #dddddd;">Product Code</th>
            <th style="text-align:center; background-color: #dddddd;" width="15%">Price (€)</th>
            <th style="text-align:center; background-color: #dddddd;" width="10%">Quantity</th>
            <th style="text-align:center; background-color: #dddddd;" width="20%">Date</th>
        </tr>
    <?php

    if(mysqli_num_rows($query) > 0)
    {   
        // output data of each row
        while($row = mysqli_fetch_array($query)) 
        {
            if ($query->num_rows > 0) 
            {
                ?>  <tr> <?php 
                ?>  <td style="text-align:center;"> <?php echo $row["user_id"]; ?> </td> <?php 
                ?>  <td style="text-align:center;"> <?php echo $row["product_name"]; ?> </td> <?php 
                ?>  <td style="text-align:center;"> <?php echo $row["product_code"]; ?> </td> <?php 
                ?>  <td style="text-align:center;"> <?php echo $row["product_price"]; ?> </td> <?php 
                ?>  <td style="text-align:center;"> <?php echo $row["quantity"]; ?> </td> <?php 
                ?>  <td style="text-align:center;"> <?php echo $row["datetime"]; ?> </td> <?php 
                ?>  </tr> <?php 
            }
        }
    } 
    else 
    { 
        echo "There are no orders yet!"; 
    }    
    ?>
        <tr>

    </table>  

    <?php
?>

<!-- CSS connection -->
<HTML>
<HEAD>
<TITLE>TechEShop</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>