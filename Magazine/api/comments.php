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

header("Content-Type:application/json");

if($url == '/comment' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $comments = getAllComments();
    echo json_encode($comments);
}
//return single cmt
if(preg_match("/comments\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $commentId = $matches[1];
    $comment = getComment($dbConn, $commentId);
    echo json_encode($comment);
}

if($url == '/comments' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $commentId = addComment($input, $dbConn);
    if($commentId){
        $input['id'] = $commentId;
        $input['link'] = "/comments/$commentId";
    }
    echo json_encode($input);
}

if(preg_match("/comments\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
    $input = $_GET;
    $commentId = $matches[1];
    updateComment($input, $dbConn, $commentId);
    $comment = getComment($dbConn, $commentId);
    echo json_encode($comment);
}

if(preg_match("/comments\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $commentId = $matches[1];
    deleteComment($dbConn, $commentId);
    echo json_encode([
        'id'=> $commentId,
        'deleted'=> 'true'
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
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    var_dump($statement);
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
    (name, content, comment_id)
    VALUES
    (:name, :content, :comment_id)";
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
    $allowedFields = ['name', 'content', 'comment_id'];
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
    $allowedFields = ['name', 'content', 'comment_id'];
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
    WHERE id=':commentId'";
    $statement = $db->prepare($sql);
    bindAllValues($statement, $input);
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
    $statement = $db->prepare("DELETE FROM comments where id=':id'");
    $statement->bindValue(':id', $id);
    $statement->execute();
}
?>