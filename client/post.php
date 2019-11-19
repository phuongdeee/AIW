<?php include('../api/comments.php'); ?>
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
		<?php include('header.php'); ?>
		<?php
		try 
			{
				$cmts_list = file_get_contents("http://localhost:8000/comments");
				$cmts = json_decode($cmts_list);
			} 
		catch (Exception $e) 
			{
				die('ERROR: ' . $e->getMessage());
			}
		
	?>
		<div class="site-main-container">
			<!-- Start top-post Area -->
			<section class="top-post-area pt-10">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-12">
							<!-- <div class="hero-nav-area">
								<h1 class="text-white">Image Post</h1>
								<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span><a href="#">Post Types </a><span class="lnr lnr-arrow-right"></span><a href="image-post.php">Image Post </a></p>
							</div> -->
                            <img src="../img/banner-post.jpg" style="width:1140px">
						</div>
						<!-- <div class="col-lg-12">
							<div class="news-tracker-wrap">
								<h6><span>Breaking News:</span>   <a href="#">Astronomy Binoculars A Great Alternative</a></h6>
							</div>
						</div> -->
					</div>
				</div>
			</section>
			<!-- End top-post Area -->
			<!-- Start latest-post Area -->
			<section class="latest-post-area pb-120">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list">
							<!-- Start single-post Area -->
							<div class="single-post-wrap">
								<div class="feature-img-thumb relative">
									<div class="overlay overlay-bg"></div>
									<img class="img-fluid" src="../img/f1.jpg" alt="">
								</div>
								<div class="content-wrap">
									<ul class="tags mt-10">
										<li><a href="#">Food Habit</a></li>
									</ul>
									<a href="#">
										<h3>A Discount Toner Cartridge Is Better Than Ever.</h3>
									</a>
									<ul class="meta pb-20">
										<li><a href="#"><span class="lnr lnr-user"></span>Mark wiens</a></li>
										<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
										<li><a href="#"><span class="lnr lnr-bubble"></span>06 </a></li>
									</ul>
									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
									</p>
									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus.
									</p>
								<blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</blockquote>
								
								<div class="navigation-wrap justify-content-between d-flex">
									<a class="prev" href="#"><span class="lnr lnr-arrow-left"></span>Prev Post</a>
									<a class="next" href="#">Next Post<span class="lnr lnr-arrow-right"></span></a>
								</div>
								
								<div class="comment-sec-area">
									<div class="container">
										<div class="row flex-column">
										<?php $count = count($cmts)?>
											<h6><?php echo $count;?> Comments</h6>
											<!-- Single cmt starts -->
											<?php 
											if($count > 0){
												for($i = 0; $i < $count ; $i++){ ?>
												<div class="comment-list">
													<div class="single-comment justify-content-between d-flex">
														<div class="user justify-content-between d-flex">
															<div class="thumb">
																<img src="<?php echo $cmts[$i]->avatar; ?>" alt="">
															</div>
															<div class="desc">
																<h5><a href="#"><?php echo $cmts[$i]->user_name; ?></a></h5>
																<p class="date"><?php echo $cmts[$i]->created_at; ?> </p>
																<p class="comment">
																<?php echo $cmts[$i]->content; ?>
																</p>
															</div>
														</div>
														<div class="reply-btn">
															<a href="" class="btn btn-outline-info">
															<img src="../open-iconic-master/svg/pencil.svg">
															</a>
															<a href="" class="btn btn-outline-danger">
															<img src="../open-iconic-master/svg/trash.svg">
															</a>
														</div>
													</div>
												</div>
											<?php 
												}
											}else{
												echo "No comment";
											}
											?>
											<!-- Single cmt ends -->
											<!-- reply of a cmt starts -->
											<!-- <div class="comment-list left-padding">
												<div class="single-comment justify-content-between d-flex">
													<div class="user justify-content-between d-flex">
														<div class="thumb">
															<img src="../img/blog/c2.jpg" alt="">
														</div>
														<div class="desc">
															<h5><a href="#">Emilly Blunt</a></h5>
															<p class="date">December 4, 2017 at 3:12 pm </p>
															<p class="comment">
																Never say goodbye till the end comes!
															</p>
														</div>
													</div>
													<div class="reply-btn">
														<a href="" class="btn-reply text-uppercase">reply</a>
													</div>
												</div>
											</div> -->
											<!-- reply of a cmt ends -->
											<!-- <div class="comment-list">
												<div class="single-comment justify-content-between d-flex">
													<div class="user justify-content-between d-flex">
														<div class="thumb">
															<img src="../img/blog/c3.jpg" alt="">
														</div>
														<div class="desc">
															<h5><a href="#">Emilly Blunt</a></h5>
															<p class="date">December 4, 2017 at 3:12 pm </p>
															<p class="comment">
																Never say goodbye till the end comes!
															</p>
														</div>
													</div>
													<div class="reply-btn">
														<a href="" class="btn-reply text-uppercase">reply</a>
													</div>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="comment-form">
								<h4>Post Comment</h4>
								<form action="post.php" method="GET">
									<div class="form-group form-inline">
										<div class="form-group col-lg-6 col-md-12 name">
											<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'" required>
										</div>
										<!-- <div class="form-group col-lg-6 col-md-12 email">
											<input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
										</div> -->
									</div>
									<!-- <div class="form-group">
										<input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
									</div> -->
									<div class="form-group">
										<textarea class="form-control mb-10" rows="5" name="message" id="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
									</div>
									<input type="submit" class="primary-btn text-uppercase name="add_cmt" value="post comment" > 
									<!-- <a href="#" class="primary-btn text-uppercase">Post Comment</a> -->
								</form>
							</div>
						</div>
						<!-- End single-post Area -->
					</div>
					<?php include('right_sidebar.php');?>
				</div>
			</div>
		</section>
		<!-- End latest-post Area -->
	</div>
	
	<!-- start footer Area -->
	<?php include('footer.php'); ?>
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
<?php
if($_GET['name'] !== NULL && $_GET['message'] !== NULL){
	$name = $_GET['name'];
	$avata = "../img/blog/c2.jpg";
	$mess = $_GET['message'];
	$created_at = "2019-11-11";
	$updated_at = "2019-11-11";
	$data = array(6,$name,$avata,$mess,$created_at,$updated_at);
	var_dump($data);
	$index = CallAPI('POST','http://localhost:8000/comments',$data);
}
?>
</html>
