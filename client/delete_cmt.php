
<?php
include('api_function.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        CallAPI('DELETE','http://localhost:8000/comments/'.$id,false);
        header('Location:http://localhost/aiw_magazine/client/post.php?id='.$_GET['id']);
       
    }

?>