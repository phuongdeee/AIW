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

// header("Content-Type:application/json");


if($url == '/categories' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $categories = getAllCategories($dbConn);
    echo json_encode($categories);
}
//return single post
if(preg_match("/categories\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $categoryId = $matches[1];
    $post = getCategory($dbConn, $categoryId);
    echo json_encode($post);
}


/**
 * Get a single post
 *
 * @param $id
 * @param $db
 * @return mixed
 */
function getCategory($db, $id) {
    $statement = $db->prepare("SELECT * FROM categories where id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
* Get all categories
*
* @param $db
* @return mixed
*/
function getAllCategories($db) {
    $statement = $db->prepare("SELECT * FROM categories");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    // var_dump($statement);
    return $statement->fetchAll();
}
