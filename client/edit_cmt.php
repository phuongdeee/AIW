<?php 
include('../api/comments.php');
include('api_function.php');
?>
<?php
$cmts = file_get_contents("http://localhost:8000/comments");
$cmts = json_decode($cmts);
    $count = count($cmts);

$id = $_GET['id'];
if(isset($_GET['id'])){
        $username;
        $mess;
        for($i = 0; $i < $count ; $i++){
            if($cmts[$i]->id == $id){
                $post_id = $cmts[$i]->post_id;
                $username = $cmts[$i]->user_name;
                $mess = $cmts[$i]->content;
            }
        }
    for($i = 0; $i < count($cmts); $i++ ){
        if($cmts[$i]->id == $id){
            if(isset($_POST['post_id'],$_POST['user_name'],$_POST['content'])){
                $new_postid = $_POST['post_id'];
                $new_username = $_POST['user_name'];
                $new_content = $_POST['content'];
                $data = $_POST;
                CallAPI('PATCH','http://localhost:8000/comments/'.$cmts[$i]->id. "?content=". $new_content,$data);
                header('Location:http://localhost/aiw_magazine/client/post.php?id='.$cmts[$i]->post_id);
            }
        }
    }
   
}
?>
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
    <div class="comment-form">
    <h4>Post Comment</h4>
    <form method="POST">
        <div class="form-group form-inline">
            <div class="form-group col-lg-6 col-md-12 name">
                <input type="text" class="form-control" name="user_name" required 
                value= "<?= $username ?>">
            </div>
            <div class="form-group col-lg-6 col-md-12 email">
                <input type="hidden" class="form-control" name="post_id" 
                value="<?= $post_id ?>">
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control mb-10" rows="5" name="content" required>
            <?php echo $mess ?>
            </textarea>
        </div>
        <input type="submit" class="primary-btn text-uppercase" name="add_cmt" value="post comment" > 
        <!-- <a href="#" class="primary-btn text-uppercase">Post Comment</a> -->
    </form>
    </div>
    </body>

