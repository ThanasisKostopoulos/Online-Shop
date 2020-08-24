<?php

	include "NavigationBar.php";
	include "Footer.php";

	require_once("dbcontroller.php");

    $db_handle = new DBController();
	$connection = $db_handle->connectDB();
    
    if(isset($_SESSION['user']))
    {

        $res= mysqli_query($connection,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
        $userRow= mysqli_fetch_array($res);
      
        if($userRow['role']=='admin')
        {
            if(isset($_POST['btn-add']))
            {
                $name= $_POST['name'];
                $code= $_POST['code'];
                $category= $_POST['category'];
                $imgpath= $_POST['img'];
                $price= $_POST['price'];

                mysqli_query($connection,"INSERT INTO products(name, code, category, image, price) VALUES ('$name','$code','$category','$imgpath', '$price')");
            }

        }
        else
            header('Location: index.php');
    }

?>


<!-- CSS connection -->
<HTML>
<HEAD>
<TITLE>TechEShop</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<center>
    <div id="add-form">
        <form method="post">    
            <div class="container">
            <h1>Add Product</h1>
            <hr>
            <label for="name"><b>Name</b></label>
            <br>
            <input type="text" placeholder="Enter Product's Name" name="name" required>
            <br><br>
            <label for="code"><b>Code</b></label>
            <br>
            <input type="text" placeholder="Enter Product's Code" name="code" required>
            <br><br>
            <label for="category"><b>Category</b></label>
            <br>
            <select id="category" name="category">
                <option value="Camera">Camera</option>
                <option value="Desktop & Laptop">Desktop & Laptop</option>
                <option value="Disk">Disk</option>
                <option value="Smart Watch">Smart Watch</option>
            </select>
            <br><br>
            <label for="picture"><b>Image Path</b></label>
            <br>
            <input type="text" placeholder="images/'[picture's name.jpg]'" name="img">
            <br><br>
            <label for="price"><b>Price</b></label>
            <br>
            <input type="number" placeholder="Enter Product's Price" name="price" required>
            <br><br>
            <div class="clearfix">
                <button type="submit" name="btn-add">Add to Products</button>
            </div>
            </div>
        </form>
        </div>
    </div>
    </center>