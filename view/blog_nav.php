<nav class="sticky-top navbar navbar-dark bg-dark">
  <div style="width: 100%">
    <div align="right" style="color:#f6f6f6">
      <?php echo "Hello  <b>" . $_SESSION['username'] . "</b>&nbsp;&nbsp;&nbsp;" ?>
      <button class="btn" onclick="
        Swal.fire({
        icon: 'warning',
        title: 'warning',
        text: '確定要登出嗎?',
        showCancelButton: true,
        }).then((result) => {
          if (result.value) {
            window.location = '/php_project_demo/view/login.php'
          }
        })"
      ><b>登出</b></button>
      <button class="btn" onclick="window.location = '/php_project_demo/view/blog.php'"><b>回部落格</b></button>
      <button class="btn" onclick="window.location = '/php_project_demo/view/write_article.php'"><b>寫點東西</b></button>
    </div>
  </div>
</nav>