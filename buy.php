<?php 
    $connect = mysqli_connect("localhost", "root", "", "alcool");
    $output = '';
    //connect
    if(isset($_POST["search"])) {
        $searchq = $_POST["search"];
        $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

        $query = mysqli_query($connect, "SELECT * FROM displaybuy WHERE name LIKE '%$searchq%' or description LIKE '%$searchq%'") or die("Could not search");
        $count = mysqli_num_rows($query);

        if($count == 0) {
            $output = '<p class="text-danger">Search came out empty</p>';
        } else {
            while($row = mysqli_fetch_array($query)) {
                $price = $row["price"];
                $name = $row["name"];
                $image = $row["image"];
                $id = $row["id"];

                $output .= '
                    <div class="col-sm" style="margin:20px 0;">
                    <form action="mycart.php" method="POST">
                        <div class="card" style="width: 18rem; d-flex flex-row">
                            <img src=./IMAGES/'.$image.' class="card-img-top img-responsive" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" name="name">'.$name.'</h5>
                                <p class="card-text">'.$row["description"].'</p>
                                <div class="d-flex flex-row justify-content-between purchase">
                                <button type="submit" name="add_to_cart" class="btn btn-warning">Purchase</button>
                                <a href="#" class="btn btn-primary price" name="hidden_price">'.$row["price"].' /=</a>
                                <input type="hidden" name="Item_Name" value='.$row["description"].'>
                                <input type="hidden" name="price" value ='.$row["price"].'>
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
                <hr>';
            }
        }
    }
?>

<?php include("./assets/header.php"); ?>
<body>
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
					<a class="nav-item nav-link" href="#products">Products</a>
					<a class="nav-item nav-link" href="./buy.php">Buy</a>
					<a class="nav-item nav-link" href="./sell.php">Sell</a>
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
            <form class="input-group mb-3 mt-3" action="./buy.php" method="post">
                    <input type="text" class="form-control" name="search" placeholder="Search for a product" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="input-group-text bg-primary text-white" type="submit" id="basic-addon2" name="submit" value="Search">
                    </div>
            </form>
            <div class="container">
                <div class="row">
                <?php print("$output"); ?>
                </div>
            </div>
            <p class="text-center text-uppercase text-lead">Search results end here</p>
            <hr class="bg-dark">
         </div>
        <main id="products">
        <h2 class="text-center text-dark text-uppercase mt-5 mb-4 d-none d-sm-none">
				Our<span style="padding: .5rem 2rem;
    clip-path: polygon(100% 0, 93% 50%, 100% 99%, 0 100%, 7% 50%, 0 0); background: #45ccb8;"> Products</span>
			</h2>
            <div class="container">
                <div class="row mt-3">
                    <?php 
                        $sql = "SELECT * FROM displaybuy ORDER BY id ASC";
                        $res = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($res) > 0) {
                            while($images = mysqli_fetch_assoc($res)) {
                                ?>
                                <div class="col-sm" style="margin:20px 0;">
                                    <form action="mycart.php" method="POST">
                                        <div class="card" style="width: 18rem;">
                                            <img src="./IMAGES/<?=$images['image']?>" class="card-img-top img-responsive" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title" name="name"><?php echo $images["name"] ?></h5>
                                                <p class="card-text"><?php echo $images["description"]; ?></p>
                                                <div class="d-flex flex-row justify-content-between purchase">
                                                <button name="add_to_cart" class="btn btn-warning">Purchase</button>
                                                <a href="#" class="btn btn-primary price" name="hidden_price"><?php echo $images["price"]; ?> /=</a>
                                                <input type="hidden" name="Item_Name" value="<?php echo $images["description"] ?>">
                                                <input type="hidden" name="price" value ="<?php echo $images["price"] ?>">
                                                </div>
                                            </div>
                                         </div>
                                    </form>
                                </div>
                           <?php }
                        }
                    ?>
               
                </div>
            </div>
        </main>
       
        <?php include("./assets/footer.php"); ?>
</body>
</html>