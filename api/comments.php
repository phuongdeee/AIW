<?php
include_once '../core/DB.php';
include_once '../config.php';

$url = $_SERVER['REQUEST_URI'];
// checking if slash is first character in route otherwise add it
if(strpos($url,"/") !== 0){
    $url = "/$url";
}
$dbInstance = new DB();
$dbConn = $dbInstance->connect($db);

// header("Content-Type:application/json");

if($url == '/comments' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $comments = getAllComments($dbConn);
    echo json_encode($comments);
}
//return single cmt
if(preg_match("/comments\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $commentId = $matches[1];
    $comment = getComment($dbConn, $commentId);
    echo json_encode($comment);
}
/*in case the function adding comment is needed */
if($url == '/comments' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $commentId = addComment($input, $dbConn);
    echo json_encode($input);
}
/* if update comment function is needed */
if(preg_match("/comments\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PATCH'){
    $input = $_GET;
    $commentId = $matches[1];
    updateComment($input, $dbConn, $commentId);
    $comment = getComment($dbConn, $commentId);
    echo json_encode($comment);
}
/* if delete comment function is needed*/
if(preg_match("/comments\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $commentId = $matches[1];
    $result = deleteComment($dbConn, $commentId);
    echo json_encode([
        'id'=> $commentId,
        'deleted'=> $result
    ]);
}
/**
 * Get a single comment
 *
 * @param $id
 * @param $db
 * @return mixed
 */
function getComment($db, $id) {
    $statement = $db->prepare("SELECT * FROM comments where id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
/**
* Get all comments
*
* @param $db
* @return mixed
*/
function getAllComments($db) {
    $statement = $db->prepare("SELECT * FROM comments");
    $statement->execute();
    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}
/**
 * Add comment
 *
 * @param $input
 * @param $db
 * @return integer
 */
function addComment($input, $db){
    $sql = "INSERT INTO comments
    (post_id, user_name, avata, content, created_at, updated_at)
    VALUES
    (:post_id, :user_name, :avata, :content, :created_at, :updated_at)";
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
    $allowedFields = ['post_id', 'user_name', 'avata', 'content', 'created_at', 'updated_at'];
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
    $allowedFields = ['post_id', 'user_name', 'avata', 'content', 'created_at', 'updated_at'];
    $filterParams = [];
    foreach($input as $param => $value){
        if(in_array($param, $allowedFields)){
            $filterParams[] = "$param=:$param";
        }
    }
    return implode(", ", $filterParams);
}
/**
 * Update Comment
 *
 * @param $input
 * @param $db
 * @param $commentId
 * @return integer
 */
function updateComment($input, $db, $commentId){
    $fields = getParams($input);
    $input['commentId'] = $commentId;
    $sql = "
    UPDATE comments
    SET $fields
    WHERE id=:commentId";
    $statement = $db->prepare($sql);
    $statement->bindValue(':commentId', $commentId);
    bindAllValues($statement, $input);
    var_dump($statement);
    $statement->execute();
    return $commentId;
}
/**
* Delete Comment record based on ID
*
* @param $db
* @param $id
*/
function deleteComment($db, $id) {
    $statement = $db->prepare("DELETE FROM comments where id=:id");
    $statement->bindValue(':id', $id);
    $result = $statement->execute();
    return $result;
}
?>