<?php 
            session_start();
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["add_to_cart"])) {
                    if (isset($_SESSION["cart"])) {
                        $myitems = array_column($_SESSION['cart'],'Item_Name');
                        if(in_array($_POST["Item_Name"],$myitems)) {
                           // echo "<script>alert('Item Already Added');</script>";
                        } else{
                        $count = count($_SESSION['cart']);
                        $_SESSION['cart'][$count]=array('Item_Name'=>$_POST['Item_Name'], 'Price'=>$_POST['price'], 'Quantity'=>1);
                       // echo "<script>alert('Item Added');</script>";
                        }
                    } else {
                        $_SESSION['cart'][0]=array('Item_Name'=>$_POST['Item_Name'], 'Price'=>$_POST['price'], 'Quantity'=>1);
                        //echo "<script>alert('Item Added');</script>";
                    }
                }
                if(isset($_POST['Remove_Item'])) {
                    foreach($_SESSION['cart'] as $key => $value) {
                        if($value['Item_Name'] == $_POST['Item_Name']) {
                            unset($_SESSION['cart'][$key]);
                            $_SESSION['cart'] = array_values($_SESSION['cart']);
                           echo "<script>alert('item removed');</script>";
                        }
                    }
                }
                if (isset($_POST['Mod_Quantity'])) {
                    foreach($_SESSION['cart'] as $key => $value) {
                        if($value['Item_Name'] == $_POST['Item_Name']) {
                            $_SESSION['cart'][$key]['Quantity'] = $_POST['Mod_Quantity'];
                            //echo "<script>alert('item removed');</script>";
                        }
                    }
                }
            }

?>

<?php include("./assets/header.php"); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light container">
			<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link active" href="./index.php"
						>Home <span class="sr-only">(current)</span></a
					>
					<a class="nav-item nav-link" href="./buy.php">Buy</a>
                </div>
			</div>
			<div class="navbar-nav">
                <?php
                $count = 0;
                if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                }
                ?>
				<a href="./mycart.php" class="btn btn-outline-success"><i class="fas fa-shopping-cart"><sup class="text-primary"><?php echo $count; ?></sup></i></a>
			</div>
		</nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center border rounded bg-light my-1">
                    <h1 class="lead">My Cart</h1>
                </div>
                    <div class="col-lg-8 my-4">
                    <table class="table table-responsive">
                        <thead class="text-center">
                            <tr>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php                                 
                                if (isset($_SESSION['cart'])) {
                                    foreach($_SESSION['cart'] as $key => $value) {
                                        $sr = $key+1;
                                        echo"
                                        <tr>
                                        <td>$sr</td>
                                        <td>$value[Item_Name]</td>
                                        <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
                                        <td>
                                            <form action='mycart.php' method='POST'>
                                                <input class='text-center iquantity' name='Mod_Quantity' onchange='this.form.submit();' type='number' value='$value[Quantity]' min='1' max='10'>
                                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                            </form>
                                        </td>
                                        <td class='itotal'></td>
                                        <td>
                                        <form action='mycart.php' method='POST'>
                                            <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>REMOVE</button>
                                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'> 
                                        </form>
                                        </td>
                                        </tr>";
                                    }
                                }
                            ?>
                        </tbody>
                        </table>
                    </div>
                    <div class="col-lg-3">
                    <div class="border bg-light rounded p-4">
                    <h4>Total:</h4>
                        <h5 class="text-right" id="gtotal"></h5>
                        <br>
                        <?php 
                            if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
                        ?>
                        <form action="./assets/purchase.php" method="POST">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" value="<?php echo $_SESSION['username'];?>" class="form-control" required disabled>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" maxlength="10" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="pay_mode" value="COD" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Cash on Delivery
                                </label>
                                </div>
                            <button class="btn btn-primary btn-block" name="purchase">Make a Purchase</button>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                    </div>
            </div>
        </div>

<script>
    var gt = 0;
    var iprice = document.getElementsByClassName("iprice");
    var iquantity = document.getElementsByClassName("iquantity");
    var itotal = document.getElementsByClassName("itotal");
    var gtotal = document.getElementById("gtotal");

function subTotal() {
    gt=0;
    for (i = 0; i < iprice.length; i++) {
        itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
        gt = gt + (iprice[i].value) * (iquantity[i].value);
    }
    gtotal.innerText = gt;
}
subTotal();
</script>
</body>
</html>