
<?php
include('api_function.php');
include('../api/comments.php');

$cmts = file_get_contents("http://localhost:8000/comments");
$cmts = json_decode($cmts);
$count = count($cmts);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $post_id = $_GET['post_id'];
    // $post_id = $_GET['post_id'];
    
            CallAPI('DELETE','http://localhost:8000/comments/'.$id,false);
            header('Location:http://localhost/aiw_magazine/client/post.php?id='.$post_id);
              
    
    
    
}
?>