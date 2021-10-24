<?php include("./assets/header.php"); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light container position-fixed fixed-top">
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
		</nav>
<body class="d-flex flex-column justify-content-center align-items-center" style="min-height:100vh;">
    <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-4" class="form-control">
        <input type="file" name="my_image">
    <div class="container mt-3">
        <input type="text" name="name" placeholder="name of the product" class="form-control input-group mb-3">
        <input type="text" name="description" placeholder="enter brief description" class="form-control input-group mb-3">
        <input type="number" name="price" placeholder="enter price" class="form-control input-group mb-3">
    </div>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>