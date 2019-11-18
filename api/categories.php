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
// /*in case the function adding category is needed */
// if($url == '/categories' && $_SERVER['REQUEST_METHOD'] == 'POST') {
//     $input = $_POST;
//     $categorytId = addCategory($input, $dbConn);
//     echo json_encode($input);
// }


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

// /**
//  * Add category
//  *
//  * @param $input
//  * @param $db
//  * @return integer
//  */
// function addCategory($input, $db){
//     $sql = "INSERT INTO categories
//     (category_name
//     VALUES
//     (:category_name)";
//     $statement = $db->prepare($sql);
//     bindAllValues($statement, $input);
//     $statement->execute();
//     return $db->lastInsertId();
// }

// /**
//  * @param $statement
//  * @param $params
//  * @return PDOStatement
//  */
// function bindAllValues($statement, $params){
//     $allowedFields = [ 'category_name'];
//     foreach($params as $param => $value){
//         if(in_array($param, $allowedFields)){
//             $statement->bindValue(':'.$param, $value);
//         }
//     }
//     return $statement;
// }