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
      if (($handle = fopen($_SERVER["DOCUMENT_ROOT"]. "/php_project_demo/src/csv/user_account.csv", "r")) !== FALSE) {
        $i=0;
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
          if($i == 0) {  // 跳過第一列
            $i++;
            continue;
          }
          $email = $data[1];
          $username = $data[2];
          $password = $data[3];
          $reg_date = $data[4];
          // echo $email. '  '. $username. '  '. $password. '  '. $reg_date. '<br>';
          $query = "INSERT INTO user_account (email, username, password, reg_date) VALUES 
            ('$email', '$username', '$password', '$reg_date')";
          $result = mysqli_query($conn, $query);
          if ($result == false) {
            echo 'Error description <br/>' . mysqli_error($conn);
          }
        }
        fclose($handle);
      }
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
      if (($handle = fopen($_SERVER["DOCUMENT_ROOT"]. "/php_project_demo/src/csv/user_article.csv", "r")) !== FALSE) {
        $i=0;
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
          if($i == 0) {  // 跳過第一列
            $i++;
            continue;
          }
          $user_id = $data[1];
          $username = $data[2];
          $title = $data[3];
          $content = $data[4];
          $img = $data[5];
          $reg_date = $data[6];
          // echo $user_id. '  '. $username. '  '. $title. '  '. $content. '  '. $img. '  '. $reg_date. '<br>';
          $query = "INSERT INTO user_article (user_id, username, title, content, img, reg_date) VALUES 
            ('$user_id', '$username', '$title', '$content', '$img', '$reg_date')";
          $result = mysqli_query($conn, $query);
          if ($result == false) {
            echo 'Error description <br/>' . mysqli_error($conn);
          }
        }
        fclose($handle);
      }
    } else {
      echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE user_message (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    content VARCHAR(100) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if (mysqli_query($conn, $sql)) {
      echo "Table user_message 新增成功";
      if (($handle = fopen($_SERVER["DOCUMENT_ROOT"]. "/php_project_demo/src/csv/user_message.csv", "r")) !== FALSE) {
        $i=0;
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
          if($i == 0) {  // 跳過第一列
            $i++;
            continue;
          }
          $article_id = $data[1];
          $username = $data[2];
          $content = $data[3];
          $reg_date = $data[4];
          // echo $article_id. '  '. $username. '  '. $content. '  '. $reg_date. '<br>';
          $query = "INSERT INTO user_message (article_id, username, content, reg_date) VALUES 
            ('$article_id', '$username', '$content', '$reg_date')";
          $result = mysqli_query($conn, $query);
          if ($result == false) {
            echo 'Error description <br/>' . mysqli_error($conn);
          }
        }
        fclose($handle);
      }
    } else {
      echo "Error creating table: " . $conn->error;
    }
  }
  return  $conn = new mysqli($servername, $username, $password, $dbname);
}
