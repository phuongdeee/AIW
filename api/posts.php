<?php
include_once '../core/DB.php';
include_once '../config.php';
$url = $_SERVER['REQUEST_URI'];
// checking if slash is first character in route otherwise add it
if (strpos($url, "/") !== 0) {
    $url = "/$url";
}
$dbInstance = new DB();
$dbConn = $dbInstance->connect($db);

header("Content-Type:application/json");


if($url == '/posts' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $posts = getAllPosts($dbConn);

    echo json_encode($posts);
}
//return single post
if(preg_match("/posts\/([0-9]{1,2}[:.,-]?$)/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $postId = $matches[1];
    $post = getPost($dbConn, $postId);
    echo json_encode($post);
}
/*in case the function adding post is needed */
if($url == '/posts' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $postId = addPost($input, $dbConn);
    echo json_encode($input);
}


/* if update post function is needed */
if(preg_match("/posts\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PATCH'){
    $input = $_GET;
    $postId = $matches[1];
    updatePost($input, $dbConn, $postId);
    $post = getPost($dbConn, $postId);
    echo json_encode($post);
}

/* if delete post function is needed*/
if(preg_match("/posts\/([0-9]{1,2}[:.,-]?$)/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $postId = $matches[1];
    $result = deletePost($dbConn, $postId);
    echo json_encode([
        'id'=> $postId,
        'deleted'=> $result
    ]);
}

/**
 * Get a single post
 *
 * @param $id
 * @param $db
 * @return mixed
 */
function getPost($db, $id) {
    $statement = $db->prepare("SELECT * FROM posts where id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
* Get all posts
*
* @param $db
* @return mixed
*/
function getAllPosts($db) {
    $statement = $db->prepare("SELECT * FROM posts");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}
/**
 * Add post
 *
 * @param $input
 * @param $db
 * @return integer
 */
function addPost($input, $db){
    $sql = "INSERT INTO posts
    (category, title, content, author, status, image, created_at, updated_at)
    VALUES
    (:category, :title, :content, :author, :status, :image, :created_at, :updated_at)";
    $statement = $db->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    return $db->lastInsertId();
}
/**
 * @param $statement
 * @param $params
 * @return PDOStatement
 */
function bindAllValues($statement, $params){
    $allowedFields = ['category', 'title', 'content', 'author', 'status', 'image', 'created_at', 'updated_at'];
    foreach($params as $param => $value){
        if(in_array($param, $allowedFields)){
            $statement->bindValue(':'.$param, $value);
        }
    }
    return $statement;
}
/**
 * Get fields as parameters to set in record
 *
 * @param $input
 * @return string
 */
function getParams($input) {
    $allowedFields = ['category', 'title', 'content', 'author', 'status', 'image', 'created_at', 'updated_at'];
    $filterParams = [];
    foreach($input as $param => $value){
        if(in_array($param, $allowedFields)){
            $filterParams[] = "$param=:$param";
        }
    }
    return implode(", ", $filterParams);
}
/**
 * Update Post
 *
 * @param $input
 * @param $db
 * @param $postId
 * @return integer
 */
function updatePost($input, $db, $postId){
    $fields = getParams($input);
    $input['postId'] = $postId;
    $sql = "
    UPDATE posts
    SET $fields
    WHERE id=:postId";
    $statement = $db->prepare($sql);
    $statement->bindValue(':postId', $postId);
    bindAllValues($statement, $input);
    var_dump($statement);
    $statement->execute();
    return $postId;
}
/**
* Delete Post record based on ID
*
* @param $db
* @param $id
*/
function deletePost($db, $id) {
    $statement = $db->prepare("DELETE FROM posts where id=:id");
    $statement->bindValue(':id', $id);
    $result = $statement->execute();
    return $result;
}

?>                                                                              