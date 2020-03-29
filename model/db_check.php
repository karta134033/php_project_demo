<?php
function db_check() {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $conn = new mysqli($servername, $username, $password);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "CREATE DATABASE user";
  $dbname = "user";
  if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE user_account (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(32) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if (mysqli_query($conn, $sql)) {
      echo "Table user_account 新增成功";
    } else {
      echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE user_article (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    title VARCHAR(50) NOT NULL,
    content VARCHAR(500) NOT NULL,
    img VARCHAR(500),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if (mysqli_query($conn, $sql)) {
      echo "Table user_article 新增成功";
    } else {
      echo "Error creating table: " . $conn->error;
    }
  } 
  return  $conn = new mysqli($servername, $username, $password, $dbname);
  
  $conn->close();
}
