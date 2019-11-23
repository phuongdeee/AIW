
<?php
include('api_function.php');
include('../api/comments.php');

$cmts = file_get_contents("http://localhost:8000/comments");
$cmts = json_decode($cmts);
$count = count($cmts);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // $cmt = CallAPI('GET','http://localhost:8000/comments/'.$id);
    // CallAPI('DELETE','http://localhost:8000/comments/'.$id,false);
    $post_id;
    var_dump($id);
    for($i = 0; $i < $count ; $i++){
        if($cmts[$i]->id == $id){
            if(isset($_POST['delete'])){
            $post_id = $cmts[$i]->post_id;
            }
        }
        CallAPI('DELETE','http://localhost:8000/comments/'.$id,false);
        header('Location:http://localhost/aiw_magazine/client/post.php?id='.$post_id);
    }
    
}

?>