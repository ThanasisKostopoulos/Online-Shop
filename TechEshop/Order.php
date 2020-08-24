<?php

	include "NavigationBar.php";
	include "Footer.php";;

	require_once("dbcontroller.php");

    $db_handle = new DBController();
	$connection = $db_handle->connectDB();
	
	if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    
                    $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
                    $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode[0]["code"] == $k) {
                                        if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                                        }
                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
					}
                }
            break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["code"] == $k)
                                unset($_SESSION["cart_item"][$k]);				
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                    }
                }
            break;
		}
	}

	//after pressing the order button the details are sending to database
	if(isset($_POST['btn-order']))
	{

		if(isset($_SESSION["cart_item"])!='')
		{
			$user= $_SESSION['user'];
			$date= date("Y-m-d H:i:s");
			$fullname= $_POST['name'];
			$email= $_POST['email'];
			$country= $_POST['country'];
			$city= $_POST['city'];
			$address= $_POST['address'];
			$payment= $_POST['payment'];

			foreach ($_SESSION["cart_item"] as $itemArray){
				$product_name= $itemArray["name"];
				$product_code= $itemArray["code"];
				$quantity= $itemArray["quantity"];
				$price= $itemArray["price"];
				$userid= $_SESSION["user_id"];
	
				mysqli_query($connection,"INSERT INTO order_items(user_id, datetime, product_name, product_code, quantity, product_price, fullname, email, country, city, address, payment) VALUES ('$user', '$date', '$product_name', '$product_code', '$quantity', '$price', '$fullname', '$email', '$country', '$city', '$address', '$payment')");

				if($connection)
				{
					foreach($_SESSION["cart_item"] as $k => $v)
					{
						unset($_SESSION["cart_item"]);
					}
					header('Location: OrderSuccess.php');
				}
				else
				{
					?>
					<script>alert('Database failure. Try again!')</script>
					<?php
				}	
	 		}
		}
		else
		{
			?>
				<script>alert('Your cart is empty! Choose some products and try again!')</script>
			<?php
		}		
	}
?>


<!-- CSS connection -->
<HTML>
<HEAD>
<TITLE>TechEShop</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>

	<div id="shopping-cart">
	<div class="txt-heading">Shopping Cart</div>

	<?php
	if(isset($_SESSION["cart_item"])){
		$total_quantity = 0;
		$total_price = 0;
	?>	
	<table class="tbl-cart" cellpadding="10" cellspacing="1">
	<tbody>
	<tr>
	<th style="text-align:left;">Name</th>
	<th style="text-align:left;">Code</th>
	<th style="text-align:right;" width="5%">Quantity</th>
	<th style="text-align:right;" width="10%">Unit Price</th>
	<th style="text-align:right;" width="10%">Price</th>
	<th style="text-align:center;" width="5%">Remove</th>
	</tr>	
	<?php		
		foreach ($_SESSION["cart_item"] as $item){
			$item_price = $item["quantity"]*$item["price"];
			?>
					<tr>
					<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
					<td><?php echo $item["code"]; ?></td>
					<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
					<td  style="text-align:right;"><?php echo "€ ".$item["price"]; ?></td>
					<td  style="text-align:right;"><?php echo "€ ". number_format($item_price,2); ?></td>
					<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"]*$item["quantity"]);
			}
			?>

	<tr>
	<td colspan="2" align="right">Total:</td>
	<td align="right"><?php echo $total_quantity; ?></td>
	<td align="right" colspan="2"><strong><?php echo "€ ".number_format($total_price, 2); ?></strong></td>
	<td></td>
	</tr>
	</tbody>
	</table>		
	<?php
	} else {
	?>
	<div class="no-records">Your Cart is Empty</div>
	<?php 
	}
	?>
	</div>
	</div>

	
    <center>
    <div id="order-form" style=	"height: 75%">
        <form method="post">    
            <div class="container">
            <h1>Complete your order</h1>
            <hr>
            <label for="name"><b>Name</b></label>
            <br>
            <input type="text" placeholder="Enter your Full Name" name="name" required>
            <br><br>
            <label for="email"><b>Email</b></label>
            <br>
            <input type="email" placeholder="Enter Email" name="email" required>
            <br><br>
            <label for="country"><b>Country</b></label>
            <br>
            <input type="text" placeholder="Enter your Country" name="country" required>
            <br><br>
            <label for="city"><b>City</b></label>
            <br>
            <input type="text" placeholder="Enter your City" name="city" required>
            <br><br>
			<label for="address"><b>Address</b></label>
			<br>
			<input type="text" placeholder="Enter your Address" name="address" required>
			<br><br>
			<label for="payment"><b>Payment Methods</b>
				<br>
				<input type="radio" id="cash" name="payment" value="cash" required>
  				<label for="cash">Cash</label>
				<input type="radio" id="bank" name="payment" value="bank">
  				<label for="bank">Bank Deposit</label><br>
			</label>
			<br><br>
            <p>By completing your order you agree to our <a href="#" style="color:maroon">Order Policy</a>.</p>
            <br><br>
            <div class="clearfix">
                <button type="submit" name="btn-order">Order now!</button>
            </div>
            </div>
        </form>
        </div>
    </div>
    </center>

</BODY>
</HTML>

<?php

    

?>