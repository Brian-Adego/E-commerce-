<?php 
	session_start(); 
	if(!isset($_SESSION['username'])) {
		header("location: login.php");
	}
?>
<?php include("./assets/header.php"); ?>
	<body>
		<?php include("./assets/navigation.php"); ?>
		<section class="main-hero container" id="home">
			<div
				class="main container d-flex justify-content-center align-items-center"
			>
				<div class="row">
					<div class="col-sm mt-5">
						<p class="lead text-uppercase">
							It's slick, It's slender, It's classic
						</p>
						<p class="lead text-uppercase">Get the best liquor</p>
						<p class="lead text-uppercase">Upto 10% off</p>
						<button class="btn btn-primary mt-5" type="submit"><a href="./buy.php" class="text-dark text-decoration-none">SEE MORE</a></button>
					</div>
					<div class="col-sm">
						<img
							src="./IMAGES/palacio.png"
							alt="palacio-bornos-sauvignon2"
							class="dd img-fluid"
						/>
					</div>
				</div>
			</div>
		</section>

		<section
			class="
				hero
				d-flex
				justify-content-center
				align-items-center
				flex-column
				mt-5
			"
			id="services"
		>
			<h2 class="text-center text-dark text-uppercase text-2">
				Our<span>Services</span>
			</h2>
			<div class="container">
				<div class="row mt-5">
					<div class="col-sm mt-3">
						<div class="card">
							<img
								src="./IMAGES/undraw_deliveries_131a.svg"
								class="card-img-top"
								alt="..."
							/>
							<div class="card-body">
								<p
									class="card-title font-weight-bold text-uppercase text-center"
								>
									Fast Delivery
								</p>
								<p class="card-text">
									Get all your products delivered quickly and conviniently via
									our cutting edge digital technologies. For complaints contact
									us
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm mt-3">
						<div class="card">
							<img
								src="./IMAGES/undraw_Scrum_board_re_wk7v.svg"
								class="card-img-top"
								alt="..."
							/>
							<div class="card-body">
								<p
									class="card-title font-weight-bold text-uppercase text-center"
								>
									Event Planning
								</p>
								<p class="card-text">
									We have a talented group of event planners who use creative
									means to make all your events memorable
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm mt-3">
						<div class="card">
							<img
								src="./IMAGES/undraw_wine_tasting_30vw.svg"
								class="card-img-top"
								alt="..."
							/>
							<div class="card-body">
								<p
									class="card-title font-weight-bold text-uppercase text-center"
								>
									Refining
								</p>
								<p class="card-text">
									We offer and sell refined liquors at an additional cost. Enjoy the
									sweetest and most elegant brands from France and Italy.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include("./assets/footer.php"); ?>
	</body>
</html>
