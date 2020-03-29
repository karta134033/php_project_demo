<?php
require dirname(__FILE__). "/login_status.php";
require dirname(__FILE__). "/blog_nav.php";
require dirname(__FILE__). "/animations/box_anime.php";
require $_SERVER["DOCUMENT_ROOT"]. "/php_project_demo/model/db_check.php";
$conn = db_check();
$sql = "SELECT id, title, content, username, img, reg_date FROM user_article ORDER BY id DESC;";
$result = mysqli_query($conn, $sql);
?>

<div 
  id="topBtnGroup"
  class="sticky-top" 
  align="center" 
  style="width: 50%; height:15%; margin:0 auto; overflow-y: scroll;"
>
  <?php
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<button onclick=\"document.getElementById('".$row["id"]. "').scrollIntoView();\">". $row["title"]."</button>";
    }
  }
  ?>
</div>
<div class="blog">
  <div class="article-lg-12 text-center">
    <h2>Blog Posts</h2>
  </div>
  <div id="blogContent" class="container" style="height: 100%; overflow-y: scroll;">
    <div class="container" align="center">
    <?php
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "<div id=\"". $row["id"]. "\" class=\"article\" align=\"left\">";
        echo "  <div class=\"text-center mt-5\"><h4>". $row["title"]. "</h4>";
        echo "    <div class=\"text-right mt-1 mr-2\" style=\"font-size:10px\">發布時間: ". $row["reg_date"]. "</div>";
        echo "    <div class=\"text-right mt-1 mr-2\" style=\"font-size:10px\">作者: " . $row["username"]. "</div>
                </div><hr>";
        if ($row["img"] !== NULL) {
          if(strlen($row["img"]) > 0) {
            $imgSrc = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://". $_SERVER['HTTP_HOST']. $row["img"];
            echo "<div class=\"text-center\" align=\"center\">
                    <img src=\" ".$imgSrc. "\" width=\"70%\">
                  </div>";
          }
        }
        echo "  <div style=\"display: flex;\">";
        echo "    <div class=\"text-center mt-5 ml-5 mr-5\" style=\"font-size:15px\">" . $row["content"]. "</div>
                </div>";
        if ($row["username"] === $_SESSION['username']) {
          echo "<div style=\"width: 100%\" align=\"right\"><button onclick=\"deletArticle(".$row["id"]. ")\"> delete</button></div>";
        }  // 刪除按鈕
        echo "</div><br>"; 
      }
    }
    ?>
    </div>
  </div>
</div>

<script>
function deletArticle(id) {
  Swal.fire({
  icon: 'warning',
  title: 'warning',
  text: '確定要刪除嗎?',
  showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      console.log('delete id', id);
      $.ajax({
        type: "POST",
        url: '/php_project_demo/model/article_check.php',
        data: {
          delete: id,
        },
        success: function(data) {
          console.log('result', data);
          if(data.includes('文章刪除成功')) {
            Swal.fire({
              icon: 'success',
              title: 'OK',
              text: '文章刪除成功',
              allowOutsideClick: false,
              showCancelButton: false,
            }).then((result) => {
              if (result.value) {
                window.location = '/php_project_demo/view/blog.php'
              }
            })
          }
        }
      });
    }
  });
}
</script>

<style>
body {
  background-color: #ffffff !important;
  /* overflow: hidden */
}

h2 {
  color: #4C4C4C;
  word-spacing: 5px;
  font-size: 30px;
  font-weight: 700;
  margin-bottom: 30px;
  font-family: 'Raleway', sans-serif;
}

.blog {
  background-color: rgba(255, 255, 255, 0);
  padding: 60px 0px;
  font-family: 'Raleway', sans-serif;
  height: 90%;
}

.article {
  background-color: rgba(175, 175, 175, 0.1);
  width: 60%;
}

#topBtnGroup button {
  background-color: rgba(175, 175, 175, 0.2);
}

#blogContent::-webkit-scrollbar, #topBtnGroup::-webkit-scrollbar
{
	width: 12px;
	background-color: rgba(0,0,0,0);
}

#blogContent::-webkit-scrollbar-thumb, #topBtnGroup::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.2);
	background-color: #ffffff;
}
</style>