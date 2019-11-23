
<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="../img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Magazine</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="../css/linearicons.css">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/magnific-popup.css">
		<link rel="stylesheet" href="../css/nice-select.css">
		<link rel="stylesheet" href="../css/animate.min.css">
		<link rel="stylesheet" href="../css/owl.carousel.css">
		<link rel="stylesheet" href="../css/jquery-ui.css">
		<link rel="stylesheet" href="../css/main.css">
	</head>
	<body>
		<?php include('header.php') ?>
		<?php
		try 
			{
				$posts_list = file_get_contents("http://localhost:8000/posts");
				$posts = json_decode($posts_list);
			} 
		catch (Exception $e) 
			{
				die('ERROR: ' . $e->getMessage());
			}
		
	?>
		<div class="site-main-container">
			<!-- Start top-post Area -->
			<!-- End top-post Area -->
			<!-- Start latest-post Area -->
			<section class="latest-post-area pb-120">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list">
							<!-- Start latest-post Area -->
							<div class="latest-post-wrap">
							<!-- Single post starts -->
							<?php $count = count($posts); 
									for($i = 0; $i < $count ; $i++){
										if($posts[$i]->category == "health"){
								?>
								<div class="single-latest-post row align-items-center">
									<div class="col-lg-5 post-left">
										<div class="feature-img relative">
											<div class="overlay overlay-bg"></div>
											<img class="img-fluid" src="<?php echo $posts[$i]->image ?>" alt="">
										</div>
										<ul class="tags">
											<li><a href="#">Health</a></li>
										</ul>
									</div>
									<div class="col-lg-7 post-right">
										<a href="post.php?id=<?= $posts[$i]->id ?>">
											<h4><?php echo $posts[$i]->title ?></h4>
										</a>
										<ul class="meta">
											<li><a href="#"><span class="lnr lnr-user"></span>
											<?php echo $posts[$i]->author ?></a></li>
											<li><a href="#"><span class="lnr lnr-calendar-full"></span>
											<?php echo $posts[$i]->created_at ?></a></li>
											<!-- <li><a href="#"><span class="lnr lnr-bubble"></span>06 Comments</a></li> -->
										</ul>
										<p class="excert"><?php echo $posts[$i]->content ?></p>
									</div>
								</div>
							<?php
										}
									}
							?>
							<!-- Single post ends -->
								<div class="load-more">
									<a href="#" class="primary-btn">Load More Posts</a>
								</div>
								
							</div>
							<!-- End latest-post Area -->
						</div>
						<?php include('right_sidebar.php') ?>
					</div>
				</div>
			</section>
			<!-- End latest-post Area -->
		</div>
		
		<!-- start footer Area -->
		<?php include('footer.php') ?>
		<!-- End footer Area -->
		<script src="../js/vendor/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="../js/vendor/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
		<script src="../js/easing.min.js"></script>
		<script src="../js/hoverIntent.js"></script>
		<script src="../js/superfish.min.js"></script>
		<script src="../js/jquery.ajaxchimp.min.js"></script>
		<script src="../js/jquery.magnific-popup.min.js"></script>
		<script src="../js/mn-accordion.js"></script>
		<script src="../js/jquery-ui.js"></script>
		<script src="../js/jquery.nice-select.min.js"></script>
		<script src="../js/owl.carousel.min.js"></script>
		<script src="../js/mail-script.js"></script>
		<script src="../js/main.js"></script>
	</body>
</html>