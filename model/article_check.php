<?php
require dirname(__FILE__) . "/article.php";
session_start();

$article = new ArticleClass();
if (isset($_POST['title'])) {
  $query = [
    'user_id' => $_SESSION['id'],
    'username' => $_SESSION['username'],
    'title' => htmlspecialchars($_POST["title"]),
    'content' => htmlspecialchars($_POST["content"]),
    'img' => $_POST["img"]
  ];
  $result = $article->insertData($query);
  echo 'result'. $result;
  exit();
}

if (isset($_POST['delete'])) {
  $result = $article->deleteData($_POST['delete']);
  echo 'result'. $result;  
  exit();
}