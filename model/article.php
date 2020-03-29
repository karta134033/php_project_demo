<?php
require dirname(__FILE__) . "/db_check.php";

class ArticleClass
{
  public function insertData($query)
  {
    $result = '';
    $user_id = $query['user_id'];
    $username =  $query['username'];
    $title = $query['title'];
    $content = $query['content'];
    $img = $query['img'];
    $img_path = '';
    if (strlen($img) > 0) {
      $timestamp = strtotime("now");
      $img_path =  '/php_project_demo/src/img/'. $timestamp. '.jpg';
      $output_file = $_SERVER["DOCUMENT_ROOT"]. $img_path;
      $ifp = fopen( $output_file, 'wb' ); 
      $data = explode( ',', $img );
      fwrite( $ifp, base64_decode($data[1]));
      fclose( $ifp );
    }
    $conn = db_check();
    $sql = "INSERT INTO user_article (user_id, username, title, content, img)
    VALUES ('$user_id', '$username', '$title', '$content', '$img_path')";
    if (mysqli_query($conn, $sql)) {
      $result = "文章新增成功";
    } else {
      $result = "Error: " . $sql . "<br>" . $conn->error;
    }
    return $result;
  }

  public function deleteData($id)
  {
    $result = '';
    $conn = db_check();
    $sql = "SELECT img FROM user_article WHERE id=$id";
    $img_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($img_result) > 0) {
      $row = mysqli_fetch_assoc($img_result);
      unlink($_SERVER["DOCUMENT_ROOT"]. $row['img']);
    }
    $sql = "DELETE FROM user_article WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
      $result = "文章刪除成功";
    } else {
      $result = "Error: " . $sql . "<br>" . $conn->error;
    }
    return $result;
  }
}
?>